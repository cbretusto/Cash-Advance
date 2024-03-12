<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <style type="text/css">
            body{
                font-family: Arial;
                font-size: 15px;
            }

            .text-green{
                color: green;
                font-weight: bold;
            }

            /*.input[type="radio"]{
                font
            }*/
        </style>
    </head>
    <body>

        <div class="row">
            <div class="col-sm-12">
                <div class="row" style="margin: 1px 10px;">
                    <div class="col-sm-12">
                        <form id="frmSaveRecord">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label style="font-size: 18px;">Good day!</label><br>
                                    <label style="font-size: 18px;">Please be notified that your Online Cash Advance Request has been approved. {{ \Carbon\Carbon::now()->toFormattedDateString() }} {{ \Carbon\Carbon::now()->isoFormat('LT') }}</label>
                                    <br><br>
                                    <hr>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>Cash Advance Details: </b></label>
                                    </div>
                                </div>

                                <br>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>CA No.           : </b><span class="text-black">{{ $data[0]->ca_no }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>DATE APPLIED     : </b><span class="text-black">{{ $data[0]->date_applied }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>MODE OF PAYMENT  : </b><span class="text-black">{{ $data[0]->mode_of_payment }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>EMPLOYEE NO.     : </b><span class="text-black">{{ $data[0]->employee_no }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>APPLICANT NAME   : </b><span class="text-black">{{ $data[0]->applicant_name }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>DEPARTMENT       : </b><span class="text-black">{{ $data[0]->official_station }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>POSITION         : </b><span class="text-black">{{ $data[0]->position }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>AMOUNT           : </b><span class="text-black">{{ $data[0]->amount_of_ca }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>AMOUNT IN WORD   : </b><span class="text-black">{{ $data[0]->ca_convert_to_word }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>PURPOSE          : </b><span class="text-black">{{ $data[0]->purpose }} </span></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b>REQUESTED BY     : </b><span class="text-black">{{ $data[0]->requested_by }} </span></label>
                                    </div>
                                </div>

                                <br>
                                <br>
                                
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">Please login your Rapidx account to get more information. Locate the Cash Advance Request System at http://rapidx/.</label>
                                    </div>
                                </div>

                                <br>
                                <br>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b> Notice of Disclaimer: </b></label>
                                        <br>
                                        <label class="col-sm-12 col-form-label"></label>   This message contains confidential information intended for a specific individual and purpose. If you are not the intended recipient, you should delete this message. Any disclosure,copying, or distribution of this message, or the taking of any action based on it, is strictly prohibited.</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <br><br>
                                    <label style="font-size: 18px;"><b>For concerns on using the form, please contact ISS at local numbers 205, 206, or 208. You may send us e-mail at <a href="mailto: servicerequest@pricon.ph">servicerequest@pricon.ph</a></b></label>
                                </div>
                            </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </body>
</html>