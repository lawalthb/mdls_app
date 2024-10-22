<?php 

namespace App\Exports;
use App\Models\ExamSheets;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class ExamsheetsViewExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
	protected $query;

	protected $rec_id;

    public function __construct($query, $rec_id)
    {
        $this->query = $query->select(ExamSheets::exportViewFields());
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
			'Session Id',
			'Term Id',
			'Student',
			'Present Count',
			'Open Count',
			'Resume On',
			'Teacher Remark',
			'Director Comment',
			'Total Score',
			'Director Approval',
			'Updated By',
			'Class Id'
        ];
    }


    public function map($record): array
    {
        return [
			$record->id,
			$record->session_id,
			$record->term_id,
			$record->user_id,
			$record->present_count,
			$record->open_count,
			$record->resume_on,
			$record->teacher_remark,
			$record->director_comment,
			$record->total_score,
			$record->director_approval,
			$record->updated_by,
			$record->class_id
        ];
    }
}
