<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Agency;
use App\Models\Rent;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    public function show(){

        return  Inertia::render('Admin/Adminroutes/Index',[
            'nofagencies' => Agency::where('status' , '=' , 'accepted')->count(),
            'nofusers' => User::all()->count() - 1,
            'nofrents' => Rent::where('status' ,'=', 'success')->count(),
            'nofactiveusers' => User::activeUser()->get()->count()
        ]) ;
    }

    public function listag(){
        $agencies = Agency::Active('accepted')->paginate(5);
        return Inertia::render('Admin/Adminroutes/AgenciesList', [
            "agencies" => $agencies
        ]);
    }

    public function stats(){
        return Inertia::render('Admin/Adminroutes/Statistic',[
            'cWeekRents' => Rent::RentStatsWeek(0,null)->toArray(),
            'lWeekRents' => Rent::RentStatsWeek(1,null)->toArray(),
            'cWeekRevenue' => Rent::RentStatsRevenue(0,null,0.05)->toArray(),
            'lWeekRevenue' => Rent::RentStatsRevenue(1,null,0.05)->toArray()
          ]);
    }

    public function confirmAgency(String $id, String $ac){
        $actions = [
            'accept' => 'accepted',
            'refuse' => 'refused'
        ];
        if(Agency::where(['id'=> $id, 'status' => 'pending'])->exists() && array_key_exists($ac,$actions)){  
            $ag = Agency::where('id', $id)->first()->status = $actions[$ac];

        }

    }

    public function pending(){
        $pendingAgencies = Agency::where('status', 'pending')->paginate(3);
        return Inertia::render('Admin/Adminroutes/Pending', 
            ["pendingAgencies" => $pendingAgencies]
        );
    }

    public function stat(){
        return Inertia::render('Admin/Adminroutes/Statistic');
    }

    public function add(){
        return Inertia::render('Admin/Adminroutes/new');
    }

    public function rent(){
        return Inertia::render('Admin/Adminroutes/Rentinvoice');
    }

    public function loginShow(){
        return Inertia::render('Admin/Adminroutes/Login');
    }

    public function getInfo(Request $request)
    {
        $admin = User::where('id', (string) $request->session()->get('uid'))->first();
        return response()->json($admin->attributesToArray());
    }

    public function downloadusers(){
        $users = User::all();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set some properties for the spreadsheet
        $spreadsheet->getProperties()
            ->setTitle('Agencies Data')
            ->setSubject('Agencies information from the database');

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers for the spreadsheet
        $sheet->setCellValue('A1', 'RentID')
                ->setCellValue('B1', 'FirstName')
                ->setCellValue('C1', 'LastName')
                ->setCellValue('D1', 'Email')
                ->setCellValue('E1', 'phone')
                ->setCellValue('F1', 'Created At');

        // Set cell styles for headers
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Loop through users and populate data
        $row = 2; // Start from row 2 (to skip header)
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->id)
                  ->setCellValue('B' . $row, $user->firstName)
                  ->setCellValue('C' . $row, $user->lastName)
                  ->setCellValue('D' . $row, $user->email)
                  ->setCellValue('E' . $row, $user->phone)
                  ->setCellValue('F' . $row, $user->created_at->format('Y-m-d H:i:s'));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $cdate = date("Y-m-d");
        $filename = "user_data_$cdate.xlsx";
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
    public function downloadagencies(){
        $agency = Agency::all();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set some properties for the spreadsheet
        $spreadsheet->getProperties()
            ->setTitle('User Data')
            ->setSubject('User information from the database');

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers for the spreadsheet
        $sheet->setCellValue('A1', 'ID')
                ->setCellValue('B1', 'AgencyName')
                ->setCellValue('C1', 'OwnerName')
                ->setCellValue('D1', 'Email')
                ->setCellValue('E1', 'phone')
                ->setCellValue('F1', 'Created At');


        // Set cell styles for headers
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Loop through users and populate data
        $row = 2; // Start from row 2 (to skip header)
        foreach ($agency as $agency) {
            $sheet->setCellValue('A' . $row, $agency->id)
                ->setCellValue('B' . $row, $agency->agencyName)
                ->setCellValue('C' . $row, $agency->ownerName)
                ->setCellValue('D' . $row, $agency->email)
                ->setCellValue('E' . $row, $agency->phone)
                ->setCellValue('F' . $row, $agency->created_at->format('Y-m-d H:i:s'));

            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $cdate = date("Y-m-d");
        $filename = "agency_data_$cdate.xlsx";
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function downloadrents(){

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set some properties for the spreadsheet
        $spreadsheet->getProperties()
            ->setTitle('Rents Data')
            ->setSubject('Rents information from the database');

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers for the spreadsheet
        $sheet->setCellValue('A1', 'RentID')
                ->setCellValue('B1', 'Full Name')
                ->setCellValue('C1', 'Agency Name')
                ->setCellValue('D1', 'Car')
                ->setCellValue('E1', 'Request Date')
                ->setCellValue('F1', 'Price/Day')
                ->setCellValue('G1', 'Total')
                ->setCellValue('H1', 'StartDate')
                ->setCellValue('I1', 'EndDate')
                ->setCellValue('J1', 'Status');
        // Set cell styles for headers
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        // Loop through users and populate data
        $row = 2; // Start from row 2 (to skip header)
        foreach (Rent::all() as $rent) {
            $sheet->setCellValue('A' . $row, $rent->id)
                  ->setCellValue('B' . $row, $rent->user()->first()->firstName.' '.$rent->user()->first()->lastName)
                  ->setCellValue('C' . $row, $rent->car()->first()->agency()->first()->agencyName)
                  ->setCellValue('D' . $row, $rent->car()->first()->carMark .'-'. $rent->car()->first()->carModel)
                  ->setCellValue('E' . $row, $rent->requestDate)
                  ->setCellValue('F' . $row, $rent->car()->first()->price)
                  ->setCellValue('G' . $row, date_diff(date_create($rent->endDate),date_create($rent->startDate))->days * $rent->car()->first()->price)
                  ->setCellValue('H' . $row, $rent->startDate)
                  ->setCellValue('I' . $row, $rent->endDate)
                  ->setCellValue('J' . $row, ucfirst($rent->status));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $cdate = date("Y-m-d");
        $filename = "rents_data_$cdate.xlsx";
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
