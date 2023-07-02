<!DOCTYPE html>
<html>
  <head>
     <style>
       .col-1 {
          width: 8.33%;
          float: left;
      }
      .col-2 {
          width: 16.66%;
          float: left;
      }
      .col-3 {
          width: 25%;
          float: left;
      }
      .col-4 {
          width: 33.33%;
          float: left;
      }
      .col-5 {
          width: 41.66%;
          float: left;
      }
      .col-6 {
          width: 50%;
          float: left;
      }
      .col-7 {
          width: 58.33%;
          float: left;
      }
      .col-8 {
          width: 66.66%;
          float: left;
      }
      .col-9 {
          width: 75%;
          float: left;
      }
      .col-10 {
          width: 83.33%;
          float: left;
      }
      .col-11 {
          width: 91.66%;
          float: left;
      }
      .col-12 {
          width: 100%;
          float: left;
      }
      .col-13{
        width: 22%;
        float: left;

      }
      .col-14{
        width: 77.9%;
        float: left;
      }
      .khmer-moul{
        font-family:moul;
      }
      
      table, th, td {          
        border-collapse: collapse;
        color: #111111;
        font-size:12px;
        border: .5px solid black;
        padding: 2px;          
      }
      table tr th {                    
        padding: 1px; 
        font-size:12px;         
      }
      table tr td {                    
        padding: 2px; 
        font-size:11px;         
      }

        .td-border-non{
            border: none;
        }
        .table-non-border tr td{
            border: none;
        }
        .line-height-2{
            line-height: 2;
        }
        .th-color tr th {
          background-color: rgb(223, 223, 223);
          font-size: 12px;
          height: 30px;
        }
        .heading-title-center{
            font-family:moul;
            font-size:12px;
            text-align:right; 
            margin-right: 20px;
            margin-top: -50px;
        } 
        .heading-title-right{
            font-size:12px;
            text-align:left; 
            margin-top: -50px;
        }                                   
        .text-center{
          text-align:center;
        }
        .text-left{
          text-align:left;
        }
        .text-right{
          text-align:right;
        }

        .header {
            background-color: #9933cc;
            color: #ffffff;            
        }     
        .heading-title-left{
            font-family:moul;
            font-size:11px;
            text-align:left;      
          
        } 
        .content{
          margin-top: 10px;
        }
        img {margin-top:-30px}         
        @media screen and (max-width: 768px) {
          table {
            width: 100%;
          }
        }
  </style>
  </head>
  <body> 
      <div class="heading-title-left">
            <img  style="width:70px;" src="data:image/png;base64,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">
            <br/>
            {{-- {{ __('form.system_name') }} --}}
      </div>
      <div class="content">
        @yield('html')
      </div>        
    </body>
</html>
