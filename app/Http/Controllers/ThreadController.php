<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Channel,
    Thread,
    User
};

class ThreadController extends Controller
{

    private $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        $channelParam = $request->channel;

        if (null !== $channelParam) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate();
        } else {
            $threads = $this->thread
                ->orderBy('created_at', 'DESC')
                ->paginate();
        }

        return view('threads.index', ['threads' => $threads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {

        $channels = $channel::all();
        return view('threads.create', [
            'channels' => $channels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try {

            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);

            $user = User::find(1);
            // cria o registro de thread através do relacionamento com o model User ($user->threads())
            $thread = $user->threads()->create($thread);

            flash('Tópico criado com sucesso')->success();

            return redirect()->route('threads.show', $thread->slug);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Algo de errado não está certo';

            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $thread = $this->thread->whereSlug($slug)->first();
        if (!$thread) {
            return redirect()->route('threads.index');
        }
        return view('threads.show', ['thread' => $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Channel $channel)
    {
        $channels = $channel::all();
        $thread = $this->thread->whereSlug($slug)->first();
        return view('threads.edit', ['thread' => $thread, 'channels' => $channels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ThreadRequest  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, $slug)
    {
        try {
            $thread = $this->thread->whereSlug($slug)->first();
            $thread->update($request->all());

            flash('Tópico atualizado com sucesso')->success();

            return redirect()->route('threads.index');
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Algo de errado não está certo';

            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $thread = $this->thread->whereSlug($slug)->first();
            $thread->delete();
            flash('Tópico excluído com sucesso')->success();

            return redirect()->route('threads.index');
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Algo de errado não está certo';

            flash($message)->warning();
            return redirect()->back();
        }
    }
}
