@extends('welcome')

@section('content')
<section class="px-5">
    <div class="card mt-2">
        <div class="card-header text-center">
            <h2>Choose your options</h2>
        </div>
        <div class="card-body p-4 p-md-3">
            <form action="{{ route('roll') }}/" method="POST">
                @csrf
                <div class="form-group row">
                  <div class="col-md-3 d-flex justify-content-md-center align-items-center p-0">
                    <label for="dices" class="form-label">
                        <p class="mb-3 mb-md-0">Number of dices</p>
                    </label>
                  </div>
                    <input type="number" id="dices" name="dices" class="col-md-2 form-input" min="1"
                        max="{{ config('dice.max_num') }}" value="1" placeholder="enter number of dices"
                        required>
                </div>
                <div class="from-group row mt-3">
                   <div class="col-md-3 d-flex justify-content-md-center align-items-center p-0">
                    <label for="dice_select" class="form-label">
                      <p class="mb-3 mb-md-0">Number of sides</p>
                    </label>
                   </div>
                    <div class="col-md-2 p-0">
                      <select id="dice_select" class="form-select mb-3 mb-md-0">
                          <option class="dice_option">dice 1</option>
                      </select>
                    </div>
                    <div class="col-lg-2 col-md-3 d-flex justify-content-md-center px-0 px-md-1 mb-3 mb-md-0">
                    <input type="number" id="sides_input" class="form-input" min="1"
                        max="{{ config('dice.max_sides') }}" value="1" placeholder="enter number of sides">
                    </div>
                    <div class="col-md-3 mb-0 d-flex align-items-center px-0 px-md-1">
                      <div class="form-check">
                          <input class="form-check-input mb-1" type="checkbox" id="changeCheckbox" checked>
                          <label class="form-check-label" for="changeCheckbox">
                            <p class="mb-3 mb-md-0">Change all dices</p>
                          </label>
                        </div>
                      </div>
                      <div id="sides">
                        <input type="hidden" name="sides[]" value="1">
                      </div>
                </div>
                <div class="form-group text-center mt-3">
                  <button class="btn btn-success btn-lg px-5" type="submit">Roll</button>
                </div>
            </form>
            @include('includes.errors')
        </div>
    </div>
</section>

@if(isset($results))
  <section class="px-5 d-flex justify-content-center flex-wrap">
      @foreach($results as $res)
        <div class="dice"><p>{{$res}}</p></div>
      @endforeach
  </section>
@endif
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
      
      @if(isset($results))
      changeDicesWidth = () => {
        let results = [];
        let max_num_length = 1;
        @foreach($results as $result)
            results.push({{$result}});
            max_num_length = Math.max(max_num_length, ({{$result}}+"").length);
        @endforeach
        let new_width =  $(".dice").css("width")
        new_width = parseInt(new_width.substring(0,new_width.length-2))/16;
        max_num_length -= 4;
        if(max_num_length > 0){
          inc_rate = 2 ** Math.log(max_num_length);
          new_width = (new_width + max_num_length + inc_rate)  + "rem";
          $(".dice").css("width", new_width)
        }
      }
      changeDicesWidth();
      @endif
        dices_num = 1;
        $("#dices").change(function () {
          let dices_input = $("#dices");
          dices_input.val(Math.max(dices_input.val(),1));
          dices_input.val(Math.min(dices_input.val(),{{ config('dice.max_num') }}));

            let dice_select = $("#dice_select");
            let dice_options = $(".dice_option");
            let dice_option = $(".dice_option").eq(0);

            let sides_div = $("#sides");
            let sides_inputs = $("input[name='sides[]'");
            let side_input = $("input[name='sides[]'").eq(0);

            let change = dices_input.val() - dices_num;
            for (i = 0; i < Math.abs(change); i++) {
                if (change < 0) {
                  dice_options[dice_options.length-1-i].remove();
                  sides_inputs[sides_inputs.length-1-i].remove();
                } else {
                  dice_select.append(dice_option.clone().text("dice " + (dice_options.length+i+1)));
                  sides_div.append(side_input.clone().attr("value",1));
                }
            }
            dices_num += change;
        });

        $("#sides_input").change(function(){
          let sides_input = $("#sides_input");
          sides_input.val(Math.max(sides_input.val(),1));
          sides_input.val(Math.min(sides_input.val(),{{ config('dice.max_sides') }}));
          if(changeCheckbox.checked){
            $("input[name='sides[]'").val(sides_input.val());
          }
          else{
            let side_input = $("input[name='sides[]'").eq($("#dice_select").prop('selectedIndex'));
            side_input.val(sides_input.val());
          }
        });

        $("#dice_select").change(function(){
            $("#sides_input").val($("input[name='sides[]'").eq($("#dice_select")
                  .prop('selectedIndex')).val());
        });
    });

</script>
@endsection
