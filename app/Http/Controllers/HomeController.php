<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Excel;
use Session;
use App\User;
use File;

class HomeController extends Controller
{	

	public function index()
	{	
		$data = User::orderby('id','DESC')->get();
		return view('addform')->with('data',$data);
	}
    public function importExcel(Request $request)
    {		
    	/*$info = ['xyz','as','sa'];
    	return $info['2'];*/

    	$validate = Validator::make($request->all(),[
            'excel'      => 'required'
        ]);
        if($validate->fails())
        {
        	return redirect()->back()->withErrors($validate)->withInput();
        }else
 		{

        if($request->hasFile('excel')){
            $extension = File::extension($request->excel->getClientOriginalName());
            
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->excel->getRealPath();
                
                $data = Excel::load($path, function($reader) {
                })->get();
                
                if(!empty($data) && $data->count()){
 					$data = $data[0];
                    foreach ($data as $key => $value) {
                        
                         $insertData=User::updateOrCreate(['email' => $value->email],[
                        'name' => $value->name,
                       	'phone' => $value->phone
                        ]);

                    }
                        if ($insertData) {

                            return redirect()->back()->with('success', 'Your Data has successfully imported');


                        }else {                        
                            return redirect()->back()->with('error', 'Error inserting the data..');
                            
                        }
                   
                }
 
                return back();
 
            }else {
                return redirect()->back()->with('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
        }
    }
    public function exportExcel(Request $request)
    {	
    	$from = $request->date;
    	$to = $request->date2;
    	$products = User::whereBetween('created_at',[$from, $to])->get();

        return \Excel::create("Users $from to $to ", function($excel) use ($products) {
            $excel->sheet('sheet name', function($sheet) use ($products)
            {	
            	$sheet->cells('A1:F1' ,function($row){

            		$row->setBackground('#CCCCCC');
            		$row->setFontColor('#FFFFFF');
            		$row->set('#FFFFFF');

            	});
            	

            	$sheet->setStyle(array(
				    'font' => array(
				        'name'      =>  'Calibri',
				        'size'      => 12 ,
				        
				  		)
				));

				$sheet->setHeight(1, 30);

                $sheet->fromArray($products);
            });
        })->download();

    }
}
