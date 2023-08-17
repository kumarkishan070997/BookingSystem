<?php

namespace App\Http\Controllers\api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function bookTicket(Request $request){
        try{
            $column_arr = [
                'A'=>"1",
                'B'=>"2",
                'C'=>"3",
                'D'=>"4",
                'E'=>"5",
                'F'=>"6",
                'G'=>"7",
                'H'=>"8",
                'I'=>"9",
                'J'=>"10",
                'K'=>"11",
                'L'=>"12",
                'M'=>"13",
                'N'=>"14",
                'O'=>"15",
                'P'=>"16",
                'Q'=>"17",
                'R'=>"18",
                'S'=>"19",
                'T'=>"20",
            ];
            $data = $request->all();
            $str = $data['seat_no'];
            $row = substr($str,1);
            $col_name = strtoupper($str[0]);
            
            $query = Ticket::where('id',$row)->first()->toArray();
            if($query && $query != null){
                if($query[$col_name]){
                    // return 'already_booked';
                    $suggested_tickets = $this->getSuggested_tickets($data);
                    return response()->json(['response' => ['code' => '200', 'message' => 'Requested tickets are not available, Here are some suggested seats.','seats'=>$suggested_tickets]]);
                }else{
                    // check adjacent seats available or not
                    if(($column_arr[$col_name] - ($data['ticket_count']-1) < 0) || $column_arr[$col_name] + ($data['ticket_count']-1) > 20){
                        $suggested_tickets = $this->getSuggested_tickets($data);
                        return response()->json(['response' => ['code' => '200', 'message' => 'Requested tickets are not available, Here are some suggested seats.','seats'=>$suggested_tickets]]);
                    }
                    // checking for left adjacent seats
                    $left_count = 0;
                    $temp_seat_no = [$data['seat_no']];
                    for($left=1;$left<$data['ticket_count'];$left++){
                        $adj_column = array_search($column_arr[$col_name]-$left,$column_arr);
                        if(!$query[$adj_column]){
                            $temp_seat_no[] = $adj_column.$row;
                            $left_count++;
                        }
                    }
                    if($left_count == $data['ticket_count'] - 1){
                        return response()->json(['response' => ['code' => '200', 'message' => 'Records fetched successfully.','seats'=>$temp_seat_no]]);
                    }

                    // checking for right adjacent seats
                    $right_count = 0;
                    $temp_seat_no = [$data['seat_no']];
                    for($right=1;$right<$data['ticket_count'];$right++){
                        $adj_column = array_search($column_arr[$col_name]+$right,$column_arr);
                        if(!$query[$adj_column]){
                            $temp_seat_no[] = $adj_column.$row;
                            $right_count++;
                        }
                    }
                    if($right_count == $data['ticket_count'] - 1){
                        return response()->json(['response' => ['code' => '200', 'message' => 'Records fetched successfully.','seats'=>$temp_seat_no]]);
                    }

                    // checking for left right adjacent seats done, if still no seats found then system will check through all the rows
                    $suggested_tickets = $this->getSuggested_tickets($data);
                    return response()->json(['response' => ['code' => '200', 'message' => 'Requested tickets are not available, Here are some suggested seats.','seats'=>$suggested_tickets]]);
                }
            }
            else{
                $suggested_tickets = $this->getSuggested_tickets($data);
                return response()->json(['response' => ['code' => '200', 'message' => 'Requested tickets are not available, Here are some suggested seats.','seats'=>$suggested_tickets]]);
            }
            return response()->json(['response' => ['code' => '400', 'message' => 'Unexpected case.']]);
        }catch(\Exception $e){
            Log::error(
                'Internal server error',
                ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]
            );
            return response()->json(['response' => ['code' => '400', 'message' => 'Unable to fetch record.']]);
        }
    }
    public function getSuggested_tickets($data){
        try{
            $query = Ticket::select('id','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T')
                            ->get()->toArray();
            if($query){
                foreach($query as $key => $value){
                    
                    // checking whether on this row any adjacent seats available or not
                    // return $value;
                    $ticket_counter = 0;
                    $tickets = [];
                    foreach($value as $tkey => $tval){
                        if($tkey != 'id'){
                            if($ticket_counter>=$data['ticket_count']){
                                return $tickets;
                            }
                            if(!$tval){
                                $tickets[]=$tkey.$value['id'];
                                $ticket_counter++;
                            }else{
                                $tickets = [];
                                $ticket_counter = 0;
                            }
                        }
                    }
                }
                return false;
            }else{
                return false;
            }
        }catch(\Exception $e){
            Log::error(
                'Internal server error',
                ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]
            );
            return false;
        }
    }
}
