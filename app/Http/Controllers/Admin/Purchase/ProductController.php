<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;

class ProductController extends Controller {

    public function __construct() {
        $this->repo = new \App\Repositories\ProductRepository();
        $this->repoCate = new \App\Repositories\PurchaseCategoryRepository();
        $this->common = new \App\Common\Common();
    }

    public function index() {
        $items = $this->repo->getItems();
        $cates = $this->repoCate->listBuilder()->get();
        return view('purchase.product', compact('items', 'cates'));
    }

    public function items(Request $request) {
        $items = $this->repo->getItems($request->all());
        $cates = $this->repoCate->listBuilder()->get();
        return view('purchase.products.list', compact('items', 'cates'));
    }

    public function create() {
        $cates = $this->repoCate->listBuilder()->get();
        return view('purchase.products.new', compact('cates'));
    }

    public function store(Request $request) {
        return $this->common->responseJson($this->repo->store($request->all()));
    }

    public function show($id) {
        $item = $this->repo->getDetail($id);
        return view('purchase.products.detail', compact('item'));
    }

    public function edit($id) {
        $item = $this->repo->getItem($id);
        $cates = $this->repoCate->listBuilder()->get();
        return view('purchase.products.edit', compact('item', 'cates'));
    }

    public function update(Request $request, $alias) {
        return $this->common->responseJson($this->repo->update($alias, $request->all()));
    }

    public function destroy($id) {
        return $this->common->responseJson($this->repo->destroy($id));
    }

    public function destroyItems(Request $request) {
        return $this->common->responseJson($this->repo->destroyItems($request->all()));
    }

    public function facebookToken() {
        $app_id = '2272091199768669';
        $app_secret = 'a698d6675b45bbbef34a9b564d08d567';
        $fb = new \Facebook\Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        //$accessToken = $helper->getAccessToken();
        //return $accessToken;
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

// Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($config['app_id']);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }

            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
    }

    public function facebookCallback() {
        return 'facebookCallback';
    }

}
