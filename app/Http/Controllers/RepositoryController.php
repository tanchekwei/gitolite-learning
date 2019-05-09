<?php

namespace App\Http\Controllers;

use App\Repository;
use Illuminate\Http\Request;

define("GIT", "git@192.168.59.131");

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output = shell_exec('ssh git@192.168.59.131 info');
        return view('repositories.index', compact('output'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repositories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validated = request()->validate([
            'name' => ['required', 'regex:/^[A-Za-z0-9_]*$/']
        ]);

        $repository = new Repository();
        $repository->name = $validated['name'];

        chdir('D:\repositories');
//        file_put_contents('conf/gitolite.conf', $lines);// insert gitolite.conf
//        shell_exec('git config user.email tarc@admin');
//        shell_exec('git config user.name TARC_Admin');
//        shell_exec('git add conf/gitolite.conf');
//        shell_exec('git commit -m '.Staff::where('user_id', Auth::user()->id)->first()->staff_id);
//        shell_exec('git pull');
//        shell_exec('git push');
        shell_exec('git clone '. config('gitolite.git_server_url') .':' . $repository->name);
//        $output = shell_exec('rm -rf '.escapeshellarg($repository->name));
//        dd($output);
        return redirect('repositories')->with('success', 'Your '.$repository->name . ' repository has been created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        //
    }
}
