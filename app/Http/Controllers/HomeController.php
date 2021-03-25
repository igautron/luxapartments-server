<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

require __DIR__.'/PHPExcel/PHPExcel.php';

class HomeController extends Controller
{
	public function index()
	{
		$img_dir = storage_path('app/public/images');
		$images = scandir($img_dir);
		unset($images[0]);
		unset($images[1]);
		return view('home', ['images' => $images]);
	}

	public function deleteImage($img_name)
	{
		$img_dir = storage_path('app/public/images/');
		unlink($img_dir.$img_name);
		return back();
	}

	public function uploadExcel(Request $req){
		$req->validate([
			'excel' => 'required|mimes:xlx,xls,xlsx',
		]);

		if($req->file()) {
			$fileName = $req->file('excel')->getClientOriginalName();
			$filePath = $req->file('excel')->storeAs('uploads', $fileName, 'public');
			// $filePath = $req->file('excel')->store('uploads');
			dump($fileName);
			dump($filePath);
			$filePath = storage_path('app/public/uploads/'.$fileName);
			// dd($filePath);

			$excel_arr = $this->readExcel($filePath);

			if ($excel_arr) {
				$excel_arr = $this->beautify_excel_arr($excel_arr);
				// dd($excel_arr);
				DB::table('products')->truncate();
				foreach ($excel_arr as $excel_row) {
					Product::create([
						'id'    => $excel_row['id'   ],
						'title'    => $excel_row['title'   ],
						'city'     => $excel_row['city'    ],
                        'category' => $excel_row['category'],
						'area'     => $excel_row['area'    ],
						'meters'   => $excel_row['meters'  ],
						'descr'    => $excel_row['descr'   ],
						'price'    => $excel_row['price'   ],
						'price1'    => $excel_row['price1'   ],
						'price2'    => $excel_row['price2'   ],
						'stage'    => $excel_row['stage'   ],
                        'terrace'  => $excel_row['terrace' ],
                        'image'   => $excel_row['image'  ],
                        'image1'   => $excel_row['image1'  ],
                        'image2'   => $excel_row['image2'  ],
                        'image3'   => $excel_row['image3'  ],
                        'image4'   => $excel_row['image4'  ],
                        'image5'   => $excel_row['image5'  ],
                        'image6'   => $excel_row['image6'  ],
					]);
				}
			}


			return back()
			->with('success', 'File has been uploaded.');
			// ->with('file', $fileName);
		}
	}

	public function uploadImages(Request $req){
		$req->validate([
			'images' => 'required',
			'images.*' => 'mimes:jpg,png'
		]);

		if($req->hasfile('images')){
			$fileNames = [];
			foreach($req->file('images') as $file)
			{
				$fileName = $file->getClientOriginalName();
				$file->storeAs('images', $fileName, 'public');
				$fileNames[] = $fileName;
			}

			return back()
			->with('success','File has been uploaded.')
			->with('file', implode(',', $fileNames));
		}
	}


	public function beautify_excel_arr($excel_arr)
	{
		if ($excel_arr[1] && $excel_arr[2]){
			$first_row = $excel_arr[1];
			unset($excel_arr[1]);
			$excel_arr = array_map(function($excel_row) use ($first_row){
				$new_row = [];
				foreach ($excel_row as $key => $value) {
					$new_row[$first_row[$key]] = $value;
				}
				return $new_row;
			}, $excel_arr);
		}
		return $excel_arr;
	}

	private function readExcel($path, $sheet = 0){
		
		// Открываем файл
		$xls = \PHPExcel_IOFactory::load($path);
		// Устанавливаем индекс активного листа
		$xls->setActiveSheetIndex($sheet);
		// Получаем активный лист
		$sheet = $xls->getActiveSheet();
		 
		$Excel_table = array();
		// Получили строки и обойдем их в цикле
		$rowIterator = $sheet->getRowIterator();
		foreach ($rowIterator as $kR=>$row) {
				// Получили ячейки текущей строки и обойдем их в цикле
				$cellIterator = $row->getCellIterator();

				$Excel_table[$kR] = array();
				foreach ($cellIterator as $kC=>$cell) {
						$Excel_table[$kR][$kC] = $cell->getCalculatedValue();
				}
		}
		return $Excel_table;
	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
}
