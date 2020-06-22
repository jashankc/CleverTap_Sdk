/* NOT WORKING */

/* get csv from button */


if(isset($_POST["submit"]))
{
   if($_FILES['file']['name'])
   {
	/* Check if the file is CSV */
     $filename = explode(".", $_FILES['file']['name']);
     if($filename[1] == 'csv')
       {
		/*convert csv in to json */
     	   if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
            $csvs = [];
            while(! feof($handle)) {
            $csvs[] = fgetcsv($handle);
          }
        $datas = [];
        $column_names = [];
        foreach ($csvs[0] as $single_csv) {
        $column_names[] = $single_csv;
       }
      foreach ($csvs as $key => $csv) {
          if ($key === 0) {
            continue;
          }
          foreach ($column_names as $column_key => $column_name) {
            $datas[$key-1][$column_name] = $csv[$column_key];
          }
      }
    $json = json_encode($datas);
    fclose($handle);
    
   //---- CleverTap Endpont
        $url = 'https://api.clevertap.com/1/upload';

        //Initiate cURL.
        $ch = curl_init($url);

        //Pn
        $cleverTapJson = '{"d":[{"objectId":"25b08803c1af4e00839f530264dac6f8","type":"profile","profileData":$json"}]}';

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CleverTap-Account-Id' => 'W67-774-7Z5Z',
                                                   'X-CleverTap-Passcode' => 'IMQ-BMA-IHKL',
                                                   'Content-Type' => 'application/json; charset=utf-8')); 

        //Execute the request
        $result = curl_exec($ch);
       }
   }
}


display_errors = on
?>

<!DOCTYPE html>  
<html>  
 <head>  
  <title>Webslesson Tutorial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>  
 <body>  
  <h3 align="center">Upload User Profile on CleverTap</h3><br />
  <form method="post" enctype="multipart/form-data">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
 </body>  
</html>
