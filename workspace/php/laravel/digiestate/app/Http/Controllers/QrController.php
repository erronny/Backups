<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Language_master;
use Auth;
use App\University;
use App\Product;
use App\Document;
use App\Category;
use App\Stock;
use App\ProductDetail;
use App\DocumentDetail;
use App\OrderDetail;
use App\Order;
use App\Share;
use App\User;
use Illuminate\Support\Facades\Config;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function index($id)
    {

        $product = DocumentDetail::findOrFail($id);
        QrCode::color(52,152,219)->backgroundcolor(255,255,255)->size(300)->errorCorrection('H')->generate('https://digiestate.co.in/assets/img/documents/'.$product->url, public_path('assets/img/qr/'.$product->id.'.svg'));

        $page_title = "QR Code";
        $categories = Category::where('IsActive',1)->get();

        return view('qrcode', compact('product', 'page_title', 'categories'));
    }
}
