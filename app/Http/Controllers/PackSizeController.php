<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackSize;
use Illuminate\Support\Facades\Validator;

class PackSizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'breadcrumb' => ['Pack Size' => '#'],
            'packSizes'  => PackSize::orderBy('total')->get(),
        ];

        return view('packsize.index', $data);
    }
    
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'total' => 'required',
        ]);

        if($validateData->passes())
        {
            PackSize::create([
                'total' => $request->total,
            ]);

            return response()->json(['success'=>'Success.']);
        }
        else
        {
            return response()->json(['errors'=>$validateData->errors()->all()]);
        }
    }

    public function count(Request $request)
    {
        $packSizes = PackSize::orderByDesc('total')->get()->pluck('total')->toArray();

        $requiredPacks = array_fill_keys($packSizes, 0);
        
        $number = $request->number;
        foreach($packSizes as $size) 
        {
            $packs = floor($number/$size);
            if($packs > 0) 
            {
                $requiredPacks[$size] = $packs;
                $number -= $packs*$size;
            }
        }
        if($number > 0)
        {
            $requiredPacks[min($packSizes)]++;
        }

        $totalPacks = array_filter($requiredPacks, function($a) {
            return $a != 0;
        });

        $data = [
            'breadcrumb' => ['Pack Size' => '#'],
            'totalPacks' => $totalPacks,
        ];

        return view('packsize.count', $data);
    }

    public function update(Request $request, PackSize $packsize)
    {
        $validate = Validator::make($request->all(), [
            'total' => 'required'
        ]);

        if($validate->passes())
        {
            $packsize->update([
                'total' => $request->total
            ]);

            return response()->json(['success'=>'Success.']);
        }
        else
        {
            return response()->json(['errors'=>$validate->errors()->all()]);
        }
    }
    
    public function destroy(PackSize $packsize)
    {
        $packsize->delete();
    }
}
