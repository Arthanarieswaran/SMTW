
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    Sales Report
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> Sales Report</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
      <div class="col-md-12 col-xs-12 d-flex">
      <div class="form-group col-md-3">
            <label for="brand_name">Year</label>
            <select name="year" class="form-control" id="year" onchange="changeMonth(this.value)">
                <?php 

                for($i='2021';$i <= date("Y");$i++){ ?>
                    
                    <option value="<?php echo $i; ?>" <?php if(date("Y") == $i){echo 'Selected';}; ?>><?php echo $i; ?></option>
               <?php }
                ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="brand_name">Month</label>
            <select name="month" class="form-control" id="month">
                <?php 
                $monthName = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                $monthNumber = ['01','02','03','04','05','06','07','08','09','10','11','12'];
                $monthTotal = 12;
               
                for($i=0;$i < date("m");$i++){ ?>
                    
                    <option value="<?php echo $monthNumber[$i]; ?>" <?php if(date("m")-1 == $i){echo 'Selected';}; ?>><?php echo $monthName[$i]; ?></option>
               <?php }
                ?>
            </select>
          </div>
          <div class="form-group col-md-3" style="margin-top:28px;">
            <button class="btn btn-primary" onclick="getBalancesheet()">Search</button>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-12">
            
                                <div class="card">
                                <button class="btn btn-sm btn-success" style="width: 6%;" onclick="ExportToExcel('Sales','xlsx')">Excel</button>
                                    <div class="card-body" id="Sales">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th colspan="16" style="text-align: center;"> SMTW ( <span id="dateData" style="text-transform: uppercase;"><?php echo date("M") ?> - <?php echo date("Y") ?> </span> )</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="16" style="text-align: center;"> Sales Details</th>
                                                </tr>
                                            <tr>
                                                <th>SNO</th>
                                                <th>Date</th>
                                                <th>Bill No</th>
                                                <th>Name of the customer</th>
                                                <th>GST No</th>
                                                <th>HSN</th>
                                                <th>Item Name</th>
                                                <th>Qty</th>
                                                <th>KGS/MT</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                                <th>Tax Rate</th>
                                                <th>IGST</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>TOTAL</th>
                                            </tr>
                                            </thead>
                                            <tbody id="patchData">
                                            <tr>
                                                    <td colspan="16" style="text-align: center;">No Data Found</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>


<script type="text/javascript">
 function ExportToExcel(data,type, fn, dl) {
       var elt = document.getElementById(data);
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || (data+'.' + (type || 'xlsx')));
    }

    function getBalancesheet(){
        var monthName = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $('#dateData').html(monthName[parseInt($('#month').val()-1)]+' - '+$('#year').val());
        var formData = {
            month : $('#month').val(),
            year : $('#year').val()
        };
        $.ajax({
                url: 'getListBalancesheet',
                type: 'post',
                dataType: 'json',
                data : formData,
                success:function(response) {
                    $('#patchData').empty();
                    if(response.length > 0){
                        
                        $.each(response,function(key,value){
                            var tprice = parseFloat(value.netAmount) - parseFloat(value.amount);
                            var gstRate  = parseFloat(tprice/2);
                            var qty = value.qty;
                            var qtyName = 'Piece';
                            if(value.product_type == 'Kgs'){
                                qty = value.kgs;
                                qtyName = 'Kgs';
                            }else if(value.product_type == 'SquareFeet'){
                                qty = value.sqf;
                                qtyName = 'Sq.Feet';
                            }else if(value.product_type == 'SquareMeter'){
                                qty = value.sqm;
                                qtyName = 'Sq.Meter';
                            }
                            $('#patchData').append('<tr>'+
                        '<td>'+(key+1)+'</td>'+
                        '<td>'+moment.unix(value.dt).format("DD-MM-YYYY")+'</td>'+
                        '<td>'+value.invoice_no+'</td>'+
                        '<td>'+value.cname+'</td>'+
                        '<td>'+value.c_gst_no+'</td>'+
                        '<td>'+value.hsn+'</td>'+
                        '<td>'+value.pname+'</td>'+
                        
                        '<td>'+value.qty+'</td>'+
                        '<td>'+qty+' '+qtyName+'</td>'+
                        '<td>'+value.price+'</td>'+
                        '<td>'+value.amount+'</td>'+
                        '<td>'+value.gst_rate+'</td>'+
                        '<td>0</td>'+
                        '<td>'+gstRate.toFixed(2)+'</td>'+
                        '<td>'+gstRate.toFixed(2)+'</td>'+
                        '<td>'+value.netAmount+'</td>'+
                        '</tr')
                        })
                        
                    }else{
                        $('#patchData').append('<tr><td colspan="16" style="text-align: center;">No Data Found</td></tr>');
                    }
                }
            })
    }

    function changeMonth(data){
        var monthName = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var monthNumber = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        var monthTotal = 12;
        $('#month').empty();
        if(moment().format('Y') == data){
            for(var i=0;i < moment().format('M');i++){
                $('#month').append('<option value="'+monthNumber[i]+'">'+monthName[i]+'</option>');
            }
        }else{
            for(var i=0;i < 12;i++){
                $('#month').append('<option value="'+monthNumber[i]+'">'+monthName[i]+'</option>');
            }
        }
       
    }
</script>