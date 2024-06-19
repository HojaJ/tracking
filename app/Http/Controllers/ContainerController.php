<?php

namespace App\Http\Controllers;
use App\Models\Container;
use App\Models\Shipping;
use App\Models\Storage;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\ContainerExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ContainerController extends Controller
{

    public function index()
    {
        $shippings = Shipping::all();
        $containers = Container::where('in_arhive', 0)->orderBy('created_at','DESC')->get();
        $allstorages = Storage::all();
        $users = User::where('is_permission',2)->select('id','firstname','code')->get();
        return view('admin.container', compact('containers','allstorages', 'shippings','users'));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Container $container)
    {
        if($container->in_arhive){
            $users = User::where('is_permission',2)->select('id','firstname','code')->get();

            $allstorages = Storage::all();
            return view('admin.container.edit', compact('container','allstorages','users'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
       try {
            Container::create([
                'name' => $request->name,
                'storage_id' => $request->storage_id,
                'comment_tk' => $request->comment_tk,
                'comment_ru' => $request->comment_ru,
                'departure_date' => $request->depart_time ?: Carbon::now(),
            ]);
            return redirect()->back()->with('success', 'Контайнер добавлен');
      } catch (\Exception $e) {
          return redirect()->back()->withErrors(['message' => $e->getMessage()]);
       }
    }

    public function excel(Request $request) 
    {
        try {
            $ids = $request->data;
            $export = new ContainerExport($ids);
            return Excel::download($export, 'container.xlsx');
        } catch (\Exception $e) {
            return response()->json('Error');
        }
    }

    public function arhive(Request $request)
    {
        try {
            $container = Container::find($request->row_id);
            $container->update([
                'shipping_id' => $request->shipping_id,
                'departure_date' => $request->depart_time,
                'comment_ru' => $request->comment_ru,
                'in_arhive' => true,
                'comment_tk' => $request->comment_tk,
            ]);
            return redirect()->route('admin.container.index')->with('success', 'Контайнер отправлень');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }


    public function editContainer(Request $request)
    {
        try {
            $container = Container::find($request->row_id);
            $container->update([
                'comment_ru' => $request->comment_ru,
                'comment_tk' => $request->comment_tk,
                'comment_en' => $request->comment_en,
            ]);
            return redirect()->route('admin.inArchive')->with('success', 'Контайнер изменён');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Container $container)
    {
        try {
            $container->update([
                'name' => $request->name,
                'in_arhive' => $request->in_arhive,
                'comment_tk' => $request->comment_tk,
                'comment_ru' => $request->comment_ru,
            ]);
            return redirect()->route('admin.inArchive')->with('success', 'Архив изменен');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $container = Container::find($id);
            $container->delete();

            return redirect()->back()->with('success', 'Контайнер удалень');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request) 
    {
        try {
            $ids = $request->data;
            Container::destroy($ids);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json('Error');
        }
    }

    public function inArchive()
    {
//        $users = User::where('is_permission',2)->select('id','firstname','code')->get();
        $containers = Container::where('in_arhive', 1)->orderBy('created_at','DESC')->get();
        $allstorages = Storage::all();
        return view('admin.archive', compact('containers','allstorages'));
    }
}
