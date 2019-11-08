<?php

namespace Modules\Locales\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Entities\Horario;
use Modules\Locales\Http\Requests\CreateLocalRequest;
use Modules\Locales\Http\Requests\UpdateLocalRequest;
use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
use DB;
use Spatie\MediaLibrary\Media;
class LocalController
{
    public function index(Request $request){
      $locales = Local::where('estado', 'verificado')->get();

      return response()->json(['locales' => $locales]);
    }
}
