
<div class ="">
    <form wire:submit.prevent="saveStudent">
        <div class="row">
            <div class ="col-md-4">
                <div class="form-label">First Name</div>
                <input type="text" class="form-control" wire:model.defer="FirstName">
                @error('FirstName') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-2">
                <div class="form-label">Middle Name</div>
                <input type="text" class="form-control" wire:model.defer="MiddleName">
                @error('MiddleName') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-4">
                <div class="form-label">Last Name</div>
                <input type="text" class="form-control" wire:model.defer="LastName">
                @error('LastName') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-1">
                <div class="form-label">Suffix</div>
                <select wire:model.defer="Suffix" class="form-control">
                <option value=""></option>
                    <option value="JR">JR</option>
                    <option value="SR">SR</option>
                    <option value="I">I</I></option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                </select>
                @error('Suffix') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-4">
                <div class="form-label">Date of Birth</div>
                <input type="date" class="form-control" wire:model.defer="DateofBirth">
                @error('DateofBirth') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-6">
                <div class="form-label">Address</div>
                <textarea class="form-control" wire:model.defer="Address" row="1"></textarea>
                @error('Address') <div class="text-danger">{{ $message}}</div> @enderror
            </div>
            <div class ="col-md-2">
                <div class="form-label"><br></div>
                <input class="btn btn-primary" type="submit" value="Submit">

            </div>
        </div>
    </form>
</div>
