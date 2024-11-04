<?php 

namespace App\Exports;
use App\Models\StudentDetails;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class StudentdetailsViewFirstReportExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(StudentDetails::exportViewFirstReportFields());
        $this->rec_id = $rec_id;
    }


    public function query()
    {
        return $this->query->where("id", $this->rec_id);
    }


	public function headings(): array
    {
        return [
			'Id',
			'User Id',
			'Firstname',
			'Middlemane',
			'Lastname',
			'Dob',
			'Class Id',
			'Religion',
			'Blood Group',
			'Height',
			'Weight',
			'Measurement Date',
			'Updated At',
			'Address',
			'Gender'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->user_id,
			$record->firstname,
			$record->middlemane,
			$record->lastname,
			$record->dob,
			$record->class_id,
			$record->religion,
			$record->blood_group,
			$record->height,
			$record->weight,
			$record->measurement_date,
			$record->updated_at,
			$record->address,
			$record->gender
        ];
    }
}
