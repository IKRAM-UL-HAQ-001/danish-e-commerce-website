<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DatabaseBackupController extends Controller
{
    public function index()
    {
        $backupsDir = storage_path('app/backups');
        if (!File::exists($backupsDir)) {
            File::makeDirectory($backupsDir, 0755, true);
        }

        $files = File::files($backupsDir);
        $backups = [];
        foreach ($files as $file) {
            $backups[] = [
                'name' => $file->getFilename(),
                'size' => round($file->getSize() / 1024, 2) . ' KB',
                'date' => date('Y-m-d H:i:s', $file->getMTime()),
                'path' => $file->getPathname()
            ];
        }

        // Sort backups by date descending
        usort($backups, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('dashboard.backups.index', compact('backups'));
    }

    public function create()
    {
        // Try paths where mysqldump might be
        $mysqldumpPath = 'mysqldump';
        if (file_exists('C:/xampp/mysql/bin/mysqldump.exe')) {
            $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';
        }

        $databaseName = config('database.connections.mysql.database');
        $userName = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $backupsDir = storage_path('app/backups');
        if (!File::exists($backupsDir)) {
            File::makeDirectory($backupsDir, 0755, true);
        }

        $filename = "backup-" . date('Y-m-d_H-i-s') . ".sql";
        $filePath = $backupsDir . '/' . $filename;

        // Build command
        $command = "\"$mysqldumpPath\" --user=\"$userName\"" . ($password ? " --password=\"$password\"" : "") . " --host=\"$host\" \"$databaseName\" > \"$filePath\"";

        $returnVar = null;
        $output = null;
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            return back()->with('success', 'Database backup created successfully: ' . $filename);
        } else {
            return back()->with('error', 'Failed to create database backup. Make sure mysqldump is installed and accessible.');
        }
    }

    public function download(Request $request)
    {
        $file = $request->file_name;
        $filePath = storage_path('app/backups/' . $file);
        if (File::exists($filePath)) {
            return Response::download($filePath);
        }
        return back()->with('error', 'Backup file not found.');
    }

    public function destroy(Request $request)
    {
        $file = $request->file_name;
        $filePath = storage_path('app/backups/' . $file);
        if (File::exists($filePath)) {
            File::delete($filePath);
            return back()->with('success', 'Backup deleted successfully.');
        }
        return back()->with('error', 'Backup file not found.');
    }
}
