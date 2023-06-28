<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google_Client;
use Google_Service_PhotosLibrary;
use Google_Service_PhotosLibrary_MediaItem;
use Google\Auth\Credentials\UserRefreshCredentials;
use Google\Photos\Library\V1\PhotosLibraryClient;
use Google\Photos\Library\V1\PhotosLibraryResourceFactory;

class SyncGooglePhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $client = new \Google\Client();
        // $client->setAuthConfig('public/credentials.json'); // Path to your client_secret.json file
        // $client->addScope(\Google\Service\Drive::DRIVE_METADATA_READONLY);
        // $client->setRedirectUri('http://localhost/oauth2callback.php');
        // // offline access will give you both an access and refresh token so that
        // // your app can refresh the access token without user interaction.
        // $client->setAccessType('offline');
        // // Using "consent" ensures that your application always receives a refresh token.
        // // If you are not using offline access, you can omit this.
        // $client->setApprovalPrompt('consent');
        // $client->setIncludeGrantedScopes(true);   // incremental auth
        // $auth_url = $client->createAuthUrl();
        // dd($auth_url);

        // $code = '4/0AZEOvhXdTfF7o0PpVyYewTyiPLoViwM8t-27OczJELQrvqx0BDdRDdxxyyjgL_vRFMUVHw';
        // $client = new Google_Client();
        // $client->setAuthConfig('public/credentials.json'); // Path to your client_secret.json file
        // $client->setRedirectUri('http://localhost/google-photos/callback');
        // $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        // $client->setAccessToken($accessToken);

        // $client = new Google_Client();
        // $client->setAccessType("offline");        // offline access.  Will result in a refresh token
        // $client->setIncludeGrantedScopes(true);   // incremental auth
        // $client->setAuthConfig('public/credentials.json');
        // $client->addScope('https://www.googleapis.com/auth/photoslibrary.readonly');
        // $client->setRedirectUri('http://localhost/google-photos/callback');
        
        // $authUrl = $client->createAuthUrl();
        // return redirect()->away($authUrl);


        // $client = new Google_Client();
        // $client->setAuthConfig('public/credentials.json'); // Path to your client_secret.json file
        // $client->setAccessToken('ya29.a0AWY7Ckn672mIUNZgCBAV0mZWwy1_9Z_BwY3dFq0wAXd_nuYU28aQWkExAvoKDRXUPrekO-e6OdBrroWn4qsn7j5VvVBCdO-uZDAVdHZqr8M-gLecyLmTP2GdyqpLAwjrIx7_wdErUI3q-xbUyMTjlyNiFiCDaCgYKATASARMSFQFWKvPlReDL6WOQ6a4Ux0BQgtUZfw0163');

        // $service = new Google_Service_PhotosLibrary($client);

        // dd($service);

        // // Set the ID of the album containing the images you want to download
        // $albumId = 'YOUR_ALBUM_ID';

        // // Call the API to retrieve the media items in the album
        // $response = $service->mediaItems->search([
        //     'albumId' => $albumId,
        // ]);


        $authCredentials = new UserRefreshCredentials('https://www.googleapis.com/auth/photoslibrary.readonly', [
            'client_id' => '392403640005-pg97i2qf8nifjsgcs90an61qooupsspm.apps.googleusercontent.com',
            'client_secret' => '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',
            'refresh_token' => '1//0epi21TzvDzZKCgYIARAAGA4SNwF-L9Ir1aRV0I0Cs_EeZCwFpvxwzLrJRdqCt0x0sFsCk86jBJSYNITflk1RwNKD47HGi1BpH7g',
        ] );
        $photosLibraryClient = new PhotosLibraryClient(['credentials' => $authCredentials]);

        $pageSize = 2;

        // Create an empty array to store all media items
        $mediaItems = [];

        // Set the page token to retrieve the first page of media items
        $pageToken = null;

        // Retrieve all media items using pagination
        do {
            $response = $photosLibraryClient->listMediaItems([
                'pageSize' => $pageSize,
                'pageToken' => $pageToken,
            ]);

            // Add the retrieved media items to the array
            #$mediaItems = array_merge($mediaItems, $response->mediaItems);

            // Update the page token for the next page, if available
            $pageToken = $response->nextPageToken;
        } while ($pageToken);


        // $response = $photosLibraryClient->listAlbums();
        // foreach ($response->iterateAllElements() as $album) {
        //     // Get some properties of an album
        //     $albumId = $album->getId();
        //     $title = $album->getTitle();
        //     $productUrl = $album->getProductUrl();
        //     $coverPhotoBaseUrl = $album->getCoverPhotoBaseUrl();
        //     // The cover photo media item id field may be empty
        //     $coverPhotoMediaItemId = $album->getCoverPhotoMediaItemId();
        //     $isWriteable = $album->getIsWriteable();

        //     echo $coverPhotoBaseUrl . "\n";
        // }
    }
}
