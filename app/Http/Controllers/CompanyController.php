<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Jobs\sendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use File;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'breadcrumb'=> ['Company' => '#'],
            'employees' => Company::orderBy('name')->get(),
        ];

        return view('company.index', $data);        
    }
    
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
            'logo'  => 'required|image|dimensions:min_width=100,min_height=100',
        ]);

        if($validateData->passes())
        {
            if($request->hasFile('logo'))
            {
                $imageExt       = $request->logo->getClientOriginalExtension();
                $imageName      = Str::slug($request->name).'-'.strtotime(now()).'.'.$imageExt;
                $imagePath      = 'logo';
                $imagePathFull  = $imagePath.'/'.$imageName;
                
                if(!File::isDirectory(public_path('storage/'.$imagePath)))
                {
                    File::makeDirectory(public_path('storage/'.$imagePath));
                }
                
                $image  = $request->file('logo');
                $image_compress = Image::make($image->getRealPath());
                $image_compress->save(public_path('storage/'.$imagePath.'/'.$imageName));
            }

            Company::create([
                'name'  => $request->name,
                'email' => $request->email,
                'logo'  => $imagePathFull,
            ]);

            $mailNewCompany = [
                'title' => 'Technical Test MINI-CRM',
                'body'  => 'New company => '.$request->name
            ];
           
            sendEmailJob::dispatch($mailNewCompany);

            return response()->json(['success'=>'Success.']);
        }
        else
        {
            return response()->json(['errors'=>$validateData->errors()->all()]);
        }
    }

    public function update(Request $request, Company $company)
    {
        $validate = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
            'logo'  => 'image|dimensions:min_width=100,min_height=100',
        ]);

        if($validate->passes())
        {
            if($request->hasFile('logo'))
            {
                // save file image
                $imageExt       = $request->logo->getClientOriginalExtension();
                $imageName      = Str::slug($request->name).'-'.strtotime(now()).'.'.$imageExt;
                $imagePath      = 'logo';
                $imagePathFull  = $imagePath.'/'.$imageName;
                
                if(!File::isDirectory(public_path('storage/'.$imagePath)))
                {
                    File::makeDirectory(public_path('storage/'.$imagePath));
                }
                
                $image  = $request->file('logo');
                $image_compress = Image::make($image->getRealPath());
                $image_compress->save(public_path('storage/'.$imagePath.'/'.$imageName));
                File::delete(public_path('storage/'.$request->logo_old));
            }
            else
            {
                $imagePathFull = $request->logo_old;
            }

            $company->update([
                'name'  => $request->name,
                'email' => $request->email,
                'logo'  => $imagePathFull,
            ]);

            return response()->json(['success'=>'Success.']);
        }
        else
        {
            return response()->json(['errors'=>$validate->errors()->all()]);
        }
    }
    
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
