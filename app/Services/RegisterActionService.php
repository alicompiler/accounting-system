<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 11/23/19
 * Time: 9:26 PM
 */

namespace App\Services;


use App\Models\Action;
use App\Models\ActionFile;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Str;

class RegisterActionService {

    private $action;

    /**
     * RegisterActionService constructor.
     * @param Action $action
     */
    public function __construct(Action $action) {
        $this->action = $action;
    }


    /**
     * @throws \Throwable
     */
    public function register($files = []) {
        DB::transaction(function () use ($files){
            $this->action->save();
            foreach ($files as $file) {
                $uniqueName = Str::uuid()->toString();
                $file->storeAs('uploads', $uniqueName.'.'.$file->getClientOriginalExtension());    
                $isImage = $file->getClientOriginalExtension() == 'jpg' || $file->getClientOriginalExtension() == 'png' || $file->getClientOriginalExtension() == 'jpeg';
                ActionFile::create([
                    'action_id' => $this->action->id,
                    'filename' => $uniqueName.'.'.$file->getClientOriginalExtension(),
                    'is_image' => $isImage
                ]);
            }
        });
    }

}