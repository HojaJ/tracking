<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Exports\CargoExport;
use App\Models\Container;
use App\Models\Storage;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    public function update_cargo(Request $request)
    {
        try {
            if ($request->user_id === "0") {
                $user_id = null;
            } else {
                $user_id = User::find($request->user_id)->id;
            }

            Cargo::find($request->cargo_id)->update([
                'user_id' => $user_id
            ]);
            return response()->json([
                'cargo_id' => $request->cargo_id,
                'user_id' => $user_id
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            Cargo::create([
                'storage_id' => $request->storage_id,
                'title_ru' => $request->title_ru,
                'title_tk' => $request->title_tk,
                'title_en' => $request->title_en,
                'track_number' => $request->track_number,
                'weight' => $request->weight,
                'barcode' => $request->barcode,
                'place' => $request->place,
                'capacity' => $request->capacity
            ]);
            return redirect()->back()->with('success', 'Груз Добавлен');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Ошибка']);
        }
    }

    public function archive_cargo(Request $request)
    {
        try {
            $container = Container::find($request->container_id);
            Cargo::create([
                'storage_id' => $container->storage_id,
                'container_id' => $container->id,
                'title_ru' => $request->title_ru,
                'title_tk' => $request->title_tk,
                'title_en' => $request->title_en,

                'track_number' => $request->track_number,
                'barcode' => $request->barcode,
                'weight' => $request->weight,
                'place' => $request->place,
                'capacity' => $request->capacity
            ]);
            return redirect()->back()->with('success', 'Груз Добавлен');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Ошибка']);
        }
    }

    public function show_cargo($id)
    {
        $cargo = Cargo::find($id);
        if ($cargo) {
            $session_array = session()->get('searched');
            if (!in_array($cargo->id, $session_array)) {
                session()->push('searched', $cargo->id);
            }
            return view('user.cargo', compact('cargo'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cargo $cargo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        $allstorages = Storage::all();
        return view('admin.cargo.edit', compact('cargo', 'allstorages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cargo $cargo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cargo $cargo)
    {
        try {
            $cargo->update([
                'title_ru' => $request->title_ru,
                'title_tk' => $request->title_tk,
                'title_en' => $request->title_en,

                'track_number' => $request->track_number,
                'barcode' => $request->barcode,
                'weight' => $request->weight,
                'place' => $request->place,
                'capacity' => $request->capacity
            ]);
            return redirect()->route('admin.storage', [$cargo->storage->id])->with('success', 'Груз Обновлен');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Ошибка']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cargo $cargo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cargo $cargo)
    {
        try {
            $cargo->delete();
            return redirect()->back()->with('success', 'Груз удален');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Ошибка']);
        }
    }

    public function excel(Request $request)
    {
        try {
            $ids = $request->data;
            $export = new CargoExport($ids);
            return Excel::download($export, 'gruz.xlsx');
        } catch (\Throwable $th) {
            return response()->json('Error');
        }
    }

    public function toContainer(Request $request)
    {
        try {
            $ids = $request->data;
            $container_id = $request->container_id;
            Cargo::whereIn('id', $ids)->update(['container_id' => $container_id]);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->data;
            Cargo::destroy($ids);
            return response()->json('Success');
        } catch (\Throwable $th) {
            return response()->json('Error');
        }
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
//                $data = Cargo::where('track_number', 'like', '%'.$query.'%')->get();
                $data = Cargo::where(function ($q) use ($query) {
                    $q->where('track_number', 'like', '%' . $query . '%')
                        ->orWhere('barcode', 'like', '%' . $query . '%');
                })->get();
            }
            if (isset($data)) {
                foreach ($data as $row) {
                    $output .= '<li><a href="' . route('show_cargo', $row->id) . '">' . $row->track_number . ($row->barcode ? '. Barcode: ' . $row->barcode : '') . '</a></li>
                ';
                }
            } else {
                $output = '
               <li>Не найден</li>
               ';
            }

            return response()->json([
                'data' => $output,
            ]);
        }
    }

    public function live_search_by_code(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $code = $request->user()->code;
                if (is_null($code)) {
                    return response()->json([
                        'success' => false,
                    ]);
                }

                if ($code === $query) {
                    $user = User::where('is_permission', 2)->where('code', $query)->first();
                    $data = $user->cargos;
                }

            }

            if (isset($data)) {
                foreach ($data as $row) {
                    $output .= "<tr class='clickable-row' data-href='" . route('show_cargo', $row->id) . "' style='cursor: pointer;'><td scope='row'>" . $row->track_number . "</td><td>" . $row->weight . "</td><td>" . $row->capacity . "</td><td>" . $row->place . "</td></tr>";
                }
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $output,
            ]);
        }
    }

    public function privacy()
    {
        return view('user.privacy');
    }

    public function termOfUse()
    {
        return view('user.termOfUse');
    }

    public function sport()
    {
        return view('user.sport');
    }
}
