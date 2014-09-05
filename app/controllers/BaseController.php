<?php
namespace DoctorFinder\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Render function will decided whether requested
     * headers format is in json, ajax or html and return
     * response accordingly
     * @param $view
     * @param null $data
     * @return mixed
     */
    protected function renderContent($view, $data = null)
    {
        if (Request::isJson() || Request::ajax()) {
            return Response::json($data);
        } else {
            if (isset($data) && $data) {
                return View::make($view, $data);
            } else {
                return View::make($view);
            }
        }
    }

    /**
     * Only render json content
     * @param $data
     * @return mixed
     */
    protected function renderJSONContent($data)
    {
        return Response::json($data);
    }
}
