<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BackupWasSuccessful;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allFiles = Storage::allFiles("backups/Exptradies");

        $files =[];
        foreach($allFiles as $file){
            $size = Storage::size($file)/1024;
            array_push($files,['file'=>$file,'size'=>$size]);
        }
        return response()->json($files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try{
            Artisan::call('backup:run');
            return response()->json("Database backup was successful.");
         }catch(Exception $e){
             return response()->json($e->getMessage(),400);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file)
    {
        // $file='backups/Tingsapp/'.$file;

        // if(!Storage::exists($file)){
        //     return response()->json("Could not restore this backup.");
        // }
        // $server = Config::get('services.env_var.host');
        // $username = Config::get('services.env_var.username');
        // $password = Config::get('services.env_var.password');
        // $database = Config::get('services.env_var.database');
 
        // $cmd = "mysql -h {$server} -u {$username} -p{$password} {$database} < $file";

        // exec($cmd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
        $file='backups/Exptradies/'.$file;
        if(Storage::exists($file)){
            Storage::delete($file);
            return response()->json("Backup file deleted successfully.");
        }else{
            return response()->json("File could not be deleted.");
        }
    }
}
