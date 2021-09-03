<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ExportToCSVController extends Controller
{
    public function export()
    {
        $fileName = 'export' . Date::now() . '.csv';
        $period = Period::with('orders.books', 'orders.user', 'orders.status')->where('active', true)->first();

        if (!$period) {
            return redirect()->back();
        }

        $books = Book::all();

        $orders = $period->orders;

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['Étudiant'];

        foreach ($books as $book) {
            array_push($columns, $book->title);
        }

        array_push($columns, 'total');
        array_push($columns, 'status');

        $callback = function () use ($orders, $columns, $books) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_map('utf8_decode', array_values($columns)), ',', '"');


            foreach ($orders as $order) {
                $row = [$order->user->name];
                foreach ($books as $book) {
                    if ($order->books->contains($book->id)) {
                        array_push($row, $order->books->firstWhere('id', $book->id)->pivot->amount);
                    } else {
                        array_push($row, '');
                    }
                }
                array_push($row, $order->total);
                array_push($row, $order->status->name);

                fputcsv($file, array_map('utf8_decode', array_values($row)), ',', '"');
            }


            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
