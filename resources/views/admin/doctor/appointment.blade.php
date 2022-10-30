@extends("layouts.app")

@section("title", "Doctor Patient list")

@section("content")

<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Patient Name</th>
                            <th>Appointment Date</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->appointment_date}}</td>
                            <td>{{$item->age}}</td>
                            <td>{{$item->upazila->name}}, {{$item->city->name}}</td>
                            <td>{{$item->contact}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a onclick="Investigation({{$item}})" style="cursor: pointer;" class="text-white btn btn-info text-decoration-none">Investigation</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Investigation of: <span id="exampleModalLabel"></span></h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select onchange="TestName(event)" class="form-control">
                        <option value="">Select Test Name</option>
                        @foreach($tests as $item)
                        <option class="tests test{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <form onsubmit="addInvestigation(event)">
                    <input type="hidden" id="appointment_id" name="appointment_id">
                    <div class="row d-flex justify-content-center">
                        <div class="col-10">
                            <table class="table table-striped">
                                <thead style="background: #133346;border:0;">
                                    <tr>
                                        <th class="text-white">Test Name</th>
                                        <th class="text-white">Unit Price</th>
                                        <th class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot style="border: 0;">
                                    <tr>
                                        <th colspan="3" class="text-end">
                                            <div class="row">
                                                <div class="col-4 p-0">
                                                    <div class="input-group">
                                                        <input type="number" readonly oninput="Discount(event)" class="form-control" style="margin-left:3px;" name="discount" id="discount" value="0"><span class="btn btn-dark">%</span>
                                                    </div>
                                                </div>
                                                <div class="col-8 text-end">
                                                    <input type="hidden" id="TotalValue">
                                                    <span class="total" style="font-size: 20px;">Total: <span class="text-success">0</span> tk</span>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Investigation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push("js")
<script>
    $("#example").DataTable();
    function Investigation(item) {
        $("#myModal").modal("show");
        $("#myModal").find(".tests").removeClass("text-danger")
        $("#myModal").find(".table tbody").html("")
        $("#myModal").find("#exampleModalLabel").text(item.name)
        $("#myModal").find("#appointment_id").val(item.id)
        var total = $("#myModal").find(".total span").text("0")
        $("#myModal").find("#TotalValue").val(0)
        $("#myModal").find("#discount").val(0)
        $("#myModal").find("#discount").prop("readonly", true)
    }

    // get test
    function TestName(event) {
        $("#myModal").find(".test" + event.target.value).addClass("text-danger")
        var count = $("#myModal").find(".table tbody").html()
        if (event.target.value != "") {
            $("#myModal").find("#discount").prop("readonly", false)
            $.ajax({
                url: location.origin + "/admin/test/edit/" + event.target.value,
                method: "GET",
                success: res => {
                    let row = `
                            <tr class="${res.name.replaceAll(" ", "-")}">
                                <td class="${res.name.replaceAll(" ", "-")}">${res.name}</td>
                                <td class="${res.amount}">${res.amount}</td>
                                <td><span class="text-danger" style="cursor:pointer;" onclick="removeTest('${res.name}', ${res.amount}, ${res.id})">
                                <input type="hidden" name="test_id[]" value="${res.id}" />
                                Remove</span></td>
                            </tr>
                        `;
                    if (count != "") {
                        var total = $("#myModal").find(".total span").text()
                        var name = $("#myModal").find(".table tbody ." + res.name.replaceAll(" ", "-") + " ." + res.name.replaceAll(" ", "-")).text()
                        if (name != res.name) {
                            $("#myModal").find("select option:first-child").prop("selected", true)
                            $("#myModal").find(".table tbody").append(row)
                            $("#myModal").find(".total span").text(+Number(total) + res.amount)
                            $("#myModal").find("#TotalValue").val(+Number(total) + res.amount)
                        }
                    } else {
                        $("#myModal").find("select option:first-child").prop("selected", true)
                        $("#myModal").find(".total span").text(res.amount)
                        $("#myModal").find("#TotalValue").val(res.amount)
                        $("#myModal").find(".table tbody").append(row)
                    }
                }
            })
        }
    }
    // remove test
    function removeTest(name, amount, id) {
        $("#myModal").find("select option:first-child").prop("selected", true)
        var count = $("#myModal").find(".table tbody tr")
        var TotalValue = $("#myModal").find("#TotalValue");
        var discount = $("#myModal").find("#discount");
        var total = $("#myModal").find(".total span");
        var amount = $("#myModal").find(".table tbody ." + name.replaceAll(" ", "-") + " ." + amount).text()
        TotalValue.val(Number(TotalValue.val()) - Number(amount))
        total.text(Number(TotalValue.val())-Number(TotalValue.val())*discount.val()/100)
        $("#myModal").find(".table tbody ." + name.replaceAll(" ", "-")).remove();
        $("#myModal").find(".test" + id).removeClass("text-danger")
        if (count.length == 1) {
            $("#myModal").find("#discount").prop("readonly", true)
            discount.val(0)
            total.text(0)
            TotalValue.val(0)
        }
    }

    function addInvestigation(event) {
        event.preventDefault()
        var count = $("#myModal").find(".table tbody").html()
        var total = $("#myModal").find(".total span").text()
        var formdata = new FormData(event.target)
        formdata.append("total", Number(total))
        if (count != 0) {
            $.ajax({
                url: location.origin + "/admin/investigation",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: res => {
                    $.notify(res, "success");
                    $("#myModal").modal("hide")
                }
            })
        } else {
            alert("Cart is empty")
        }
    }

    function Discount(event) {

        var oldValue = $("#myModal").find("#TotalValue").val()
        if (event.target.value >= 0 && event.target.value <= 100) {
            var total = (Number(oldValue) * Number(event.target.value)) / 100;
            var newValue = $("#myModal").find(".total span").text(Number(oldValue) - total)
        } else {
            $("#myModal").find("#discount").val(0)
            $("#myModal").find(".total span").text(Number(oldValue))
        }
    }
</script>
@endpush