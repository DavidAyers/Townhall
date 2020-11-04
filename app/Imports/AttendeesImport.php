<?php

namespace App\Imports;

use App\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendeesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendee([
            //
            'image'             => "/uploads/avatar/attendee/default.png",
            'primary_email'     => $row[0], 
            'secondary_email'   => $row[1],
            'first_name'        => $row[2],
            'middle_name'       => $row[3], 
            'last_name'         => $row[4],
            'department'        => $row[5],
            'job'               => $row[6], 
            'manager_name'      => $row[7],
            'manager_title'     => $row[8],
            'office_location'   => $row[9], 
            'primary_number'    => $row[10],
            'cell_number'       => $row[11],
            'emergency_contract_name'   => $row[12], 
            'emergency_contract_phone'  => $row[13],
            'air_travel_assistance'     => $row[14],
            'hotel_room'                => $row[15], 
            'dietary_concerns'          => $row[16],           
            'password'                  => \Hash::make($row[17]),
            'venue_id'                  => 4,
        ]);
    }
}
