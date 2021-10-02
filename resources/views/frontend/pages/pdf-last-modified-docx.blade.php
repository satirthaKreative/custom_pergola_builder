<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@400;700&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- font-family: 'Arvo', serif; -->
</head>
<body style=" color: #333;font-family: 'Roboto', sans-serif;max-width: 900px;margin: 0 auto;">   

   
   <table style="width: 100%;border-bottom: 5px solid #7a9739;">
    <tr>
        <td style="width: 300px;color: #ce6b14; font-size: 16px;font-weight: 700;margin: 0;">
            <img src="https://custompergolabuilder.com//frontend/images/logo.png" alt="" style="    max-width: 100%;"> 
        </td>
        <td style="width: 300px;text-align: center;color: #3a3a3a;font-size: 26px;font-weight: 700;margin: 0;
    text-transform: uppercase;">
            <h3>Pargola Builder</h3>
        </td>
        <td style="width: 300px;color: #7a9739;font-size: 19px;font-weight: 400;margin: 0;text-align: right;">
            <p>sales@outdoorlivingtoday.com</p>
            <p>+1 888-658-1658</p>  
        </td>
        
    </tr>
   </table>

   <table style="     margin: 5px 0;     width: 100%;">
        <tr>
            <td style=" color: #1b1b1b;text-align: left;padding: 10px 0 10px;font-size: 18px;font-weight: 500;">
               <h3> VIEW YOUR PERGOLA</h3>
            </td>
        </tr>
        <tr>
            <td style="color: #1b1b1b;text-align: left;padding: 0px 0 10px;font-size: 15px;font-weight: 300;">
                Selected Pergola:
            </td>
        </tr>
    </table>
    <table style="width: 100%;    background: #f5f5f5;    padding: 10px 20px;">
    <tr>
        <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
             <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Width</h3>
            <p style="margin: 0;padding: 30px 0 10px; font-size: 19px; font-weight: 300;">{{ $master_width_length }} Ft</p>
        </td>
         <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
           <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Length</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $master_height_length }} Ft</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
             <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Post Length</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $piller_length }} Ft</p>
        </td>
         <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
           <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Overhead Shade</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $overhead_shades }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
             <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Mount Bracket</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $mount_count }}</p>
        </td>
         <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
           <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Retactable Canopy</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $final_canopy_type }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
             <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Louvered Panel</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $final_lpanel_type }}</p>
        </td>
         <td style="padding: 20px 0;width: 450px;color: #3e3e3e;font-size: 13px;font-weight: 700;margin: 0;">
           <h3 style="display: block;margin: 0;font-size: 20px; padding-bottom: 16px;">Wood Types</h3>
            <p style="margin: 0;padding: 0px 0 10px; font-size: 19px; font-weight: 300;">{{ $master_wood_length }}</p>
        </td>
    </tr>
    
    
   </table>

   <table style="width: 100%;border: 1px solid #7a9739;padding: 0px 20px;">
    <tr>
        <td style="color: #7a9739; font-size: 20px;font-weight: 700;margin: 0;">
            <h3>TOTAL PRICE</h3>
        </td>
        <td style="color: #7a9739; padding: 18px; padding-right: 19px; font-size: 20px; font-weight: 600;
    text-align: right;">
          <h3>  $ {{ $final_price }}</h3>
        </td>
    </tr>
   </table>
    
   <table style="  text-align: center;  width: 100%;padding: 30px 0;">
       
        
        <tr>
            <td>
                <img src="{{ $image_data }}" alt="" style=" width: 400px;   max-width: 100%;">                
            </td>
        </tr>
    </table>
   
 
   
   
   <table style="     margin:  0;     width: 100%;">  
        <tr>
            <td style="     background: #505050;
    margin: 0;
    text-align: center;
    color: #fff;
    font-size: 13px;
    padding: 10px 70px;
    font-weight: 300;">
              © COPYRIGHT 2021 PERGOLA BUILDER
            </td>           
        </tr>
    </table>

 


</body>
</html>