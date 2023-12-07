<?php

namespace App\Livewire\Student;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Students;
use Str;

class AddStudent extends Component
{
    use LivewireAlert;
    public $FirstName;
    public $MiddleName;
    public $LastName;
    public $Suffix;
    public $DateofBirth;
    public $Address;
    public $StudentID;

    public $qrcodes;

    public function mount(){
        $data = Students::find($this->StudentID);
        if($data){
            $this->FirstName = $data->FirstName;
            $this->MiddleName = $data->MiddleName;
            $this->LastName = $data->LastName;
            $this->Suffix = $data->Suffix;
            $this->DateofBirth = $data->DateofBirth; 
            $this->Address = $data->Address;

        }
    }


    public function render()
    {
        return view('livewire.student.add-student');
    }
    public function saveStudent(){
        if($this-> StudentID > 0){
            $b = Students::find($this-> StudentID);
            $b->FirstName = $this->FirstName;
            $b->MiddleName = $this->MiddleName;
            $b->LastName = $this->LastName;
            $b->Suffix = $this->Suffix;
            $b->DateofBirth = $this->DateofBirth; 
            $b->Address = $this->Address;
            $b->save();


            return redirect()->route('student.list');
        }else{
            $this->validate([
                'FirstName' => 'required',
                'LastName' => 'required',
                'DateofBirth' => 'required',
                'Address' => 'required', 
            ],[
                'FirstName.required' => 'First Name is required',
                'LastName.required' => 'Last Name is required',
                'DateofBirth.required' => 'Date of birth is required',
                'Address.required' => 'Address is required',
            ]);
            $count = Students::count();
    
            $CheckIfExist = Students::where('FirstName', $this->FirstName)
                ->where('LastName', $this->LastName)
                ->where('MiddleName', $this->MiddleName)
                ->exists();
     
                if(!$CheckIfExist){
                    $b = new Students();
                    $b->StudentID = date('Y').'-000'.$count + 1;
                    $b->FirstName = $this->FirstName;
                    $b->MiddleName = $this->MiddleName;
                    $b->LastName = $this->LastName;
                    $b->Suffix = $this->Suffix;
                    $b->DateofBirth = $this->DateofBirth; 
                    $b->Address = $this->Address;             
                    $b->save();
    
                    if($b){
                        $this->alert('success', $this->FirstName.' '.$this->LastName .' is successfully save', ['position' => 'center', 'toast' => false]);
                    } 
                    }else{
                    $this->alert('error', $this->FirstName.' '.$this->LastName .' is already exists', ['position' => 'center', 'toast' => false]);
                    };
        }
    }

    public function Generate($StudentID){

        $studentid = $StudentID;

        $studentcode = Str::slug($studentid);

        while ($this->studentCodeExists($studentcode)) {
          
            $studentcode .= '  ' . Str::random(3);
        }
    
        $this->qrcodes = $studentcode;
        Students::create($StudentID->all());

        return redirect()->route('student.list');
    }

    public function studentCodeExists($qrcodes){
        return Students::whereProductCode($qrcodes)->exists();
    }
}
