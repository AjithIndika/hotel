<div class="container mt-2"> 

    <a href="<?php echo base_url('table/tabal_bill') ?>"> 
        <button type="button" class="btn btn-success "> <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> <h3 class="text-light" style="font-size:70px"></h3></button>  
    </a>

    
    <form action="" method="post" name="calculator" class="form-inline">
    <input type="hidden" value="239" name="itemname_id" >
    <input type="text" id="display" name="itemqun" class="form-control col-sm-5 mt-2" placeholder="Enter " readonly required style="height: 80px;font-size: 40px">
    &MediumSpace;&MediumSpace;  <input type="submit" value="OK" name="tabelother"  name="doit" value="=" onclick="calculator.display.value = eval(calculator.display.value)" class=" col-sm-3 btn btn-danger font-weight-bold" style="height:80px;font-size:30px" required>
           </form> 
 <?php echo form_error('itemqun', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>    
        </br>
                 <button type="button"   name="one" value="1" onclick="calculator.display.value += '1'" class="btn btn-primary col-sm-2 mb-2 "><h2>1</h2></button>
                 <button type="button"   name="one" value="2" onclick="calculator.display.value += '2'" class="btn btn-primary col-sm-2 mb-2 "><h2>2</h2></button>
                 <button type="button"    name="one" value="3" onclick="calculator.display.value += '3'" class="btn btn-primary col-sm-2 mb-2 "><h2>3</h2></button>
                 <button type="button"    name="plus" value="+" onclick="calculator.display.value += '+'" class="btn btn-primary col-sm-2 mb-2"><h2>+</h2></button>
                 </br>
                 <button type="button"   name="one" value="4" onclick="calculator.display.value += '4'" class="btn btn-primary col-sm-2 mb-2"><h2>4</h2></button>
                 <button type="button"   name="one" value="5" onclick="calculator.display.value += '5'" class="btn btn-primary col-sm-2 mb-2"><h2>5</h2></button>
                 <button type="button"    name="one" value="6" onclick="calculator.display.value += '6'" class="btn btn-primary col-sm-2 mb-2"><h2>6</h2></button>
                 <button type="button"    name="minus" value="-" onclick="calculator.display.value += '-'" class="btn btn-primary col-sm-2 mb-2"><h2>-</h2></button>
                
                 </br>
                  <button type="button"   name="one" value="7" onclick="calculator.display.value += '7'" class="btn btn-primary col-sm-2 mb-2"><h2>7</h2></button>
                 <button type="button"   name="one" value="8" onclick="calculator.display.value += '8'" class="btn btn-primary col-sm-2 mb-2"><h2>8</h2></button>
                 <button type="button"    name="one" value="9" onclick="calculator.display.value += '9'" class="btn btn-primary col-sm-2 mb-2"><h2>9</h2></button>
                 <button type="button"    name="times" value="x" onclick="calculator.display.value += '*'" class="btn btn-primary col-sm-2 mb-2"><h2>*</h2></button>
                 </br>
                 <button type="button"   name="clear" value="c" onclick="calculator.display.value = ''" class="btn btn-primary col-sm-2 mb-2"><h2>Clear</h2></button>
                 <button type="button"   name="zero" value="0" onclick="calculator.display.value += '0'" class="btn btn-primary col-sm-2 mb-2"><h2>0</h2></button>
                 <button type="button"   name="doit" value="=" onclick="calculator.display.value = eval(calculator.display.value)" class="btn btn-primary col-sm-2 mb-2"><h2>=</h2></button>
                 <button type="button"    name="div" value="/" onclick="calculator.display.value += '/'" class="btn btn-primary col-sm-2 mb-2"><h2>/</h2></button>
                 </br>
                 
           
        </div>


<!-----

    <form name="calculator" method="post">
        <div class="container col-sm-12">
            <div class="row">
                <div class="col-sm-6 ">
                    <input type="hidden" value="239" name="itemname_id" >
                    <table>
                        <tr>
                            <td colspan="4">
                                <input type="text"  id="display" readonly  name="itemqun" required>
                             </td>
                        </tr>
                        <tr>
                            <td><input type="button" name="one" value="1" onclick="calculator.display.value += '1'"></td>
                            <td><input type="button" name="two" value="2" onclick="calculator.display.value += '2'"></td>
                            <td><input type="button" name="three" value="3" onclick="calculator.display.value += '3'"></td>
                            <td><input type="button" class="operator" name="plus" value="+" onclick="calculator.display.value += '+'"></td>
                        </tr>
                        <tr>
                            <td><input type="button" name="four" value="4" onclick="calculator.display.value += '4'"></td>
                            <td><input type="button" name="five" value="5" onclick="calculator.display.value += '5'"></td>
                            <td><input type="button" name="six" value="6" onclick="calculator.display.value += '6'"></td>
                            <td><input type="button" class="operator" name="minus" value="-" onclick="calculator.display.value += '-'"></td>
                        </tr>
                        <tr>
                            <td><input type="button" name="seven" value="7" onclick="calculator.display.value += '7'"></td>
                            <td><input type="button" name="eight" value="8" onclick="calculator.display.value += '8'"></td>
                            <td><input type="button" name="nine" value="9" onclick="calculator.display.value += '9'"></td>
                            <td><input type="button" class="operator" name="times" value="x" onclick="calculator.display.value += '*'"></td>
                        </tr>
                        <tr>
                            <td><input type="button" id="clear" name="clear" value="c" onclick="calculator.display.value = ''"></td>
                            <td><input type="button" name="zero" value="0" onclick="calculator.display.value += '0'"></td>
                            <td><input type="button" name="doit" value="=" onclick="calculator.display.value = eval(calculator.display.value)"></td>
                            <td><input type="button" class="operator" name="div" value="/" onclick="calculator.display.value += '/'"></td>

                        </tr>
                    </table>


                </div>



                <div class="col-sm-6">
                    <input type="submit" value="OK" name="tabelother" class="col-sm-12 btn btn-danger font-weight-bold bst" style="height:80px;font-size:30px">
                </div>
            </div>
        </div>
    </form>
    <style>


        table {
            margin: auto;
            background-color: #222;
            width: 295px;
            max-width: 295px;
            height: 325px;
            text-align: center;
            border-radius: 4px;
            padding-right: 10px;
        }

        input {
            outline: 0;
            position: relative;
            left: 5px;
            top: 5px;
            border: 0;
            color: #495069;
            background-color: #fff;
            border-radius: 4px;
            width: 60px;
            height: 50px;
            float: left;
            margin: 5px;
            font-size: 20px;
            box-shadow: 0 4px rgba(0,0,0,0.2);
            margin-bottom: 15px;
        }



        #display {
            width: 265px;
            max-width: 270px;
            font-size: 26px;
            text-align: right;
            background-color: #bcbd95;
            float: left;
        }

        #display:hover {
            width: 270px;
            font-size: 26px;
            text-align: right;
            background-color: #bcbd95;
            box-shadow: 0 4px rgba(0,0,0,0.2);
        }

        #display:active {
            top: 5px;
            width: 270px;
            font-size: 26px;
            text-align: right;
            background-color: #bcbd95;
            box-shadow: 0 4px rgba(0,0,0,0.2);
        }

        .operator {
            background-color: #cee9ea;
            position: relative;
        }

        .operator:hover {
            background-color: #cee9ea;
            box-shadow: 0 4px #b0d2cf;
        }

        .operator:active {
            top: 4px;
            box-shadow: none;
        }

        #clear {
            float: left;
            position: relative;
            display: block;
            background-color: #ff9fa8;
        }

        #clear:hover {
            float: left;
            display: block;
            background-color: #F297A0;
            margin-bottom: 15px;
            box-shadow: 0 4px #CC7F86;
        }

        #clear:active {
            float: left;
            top: 4px;
            display: block;
            background-color: #F297A0;
            margin-bottom: 15px;
            box-shadow: none;
        }

    </style>

   