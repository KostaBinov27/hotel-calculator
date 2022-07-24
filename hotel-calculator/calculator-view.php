<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<input class="d-none" id="pricePerDay" value="<?php echo get_option( 'pricePerDay' ); ?>">
<div class="calcWrap">
    <h1>Hotel Calculator</h1>
    <div class="sidewrap">
        <div class="lside">
            <div class="inputWrap">
                <div class="linput">
                    <label >Till</label>
                    <input id="datepickerFrom">
                </div>
                <div class="rinput">
                    <label >Since</label>
                    <input id="datepickerTo">
                </div>
            </div>
            <div class="sliderWrap">
                <label class="labelPeople">Days to book</label>
                <div class="innerWrapSlider">
                    <div id="slider"></div>
                    <input type="number" max="<?php echo get_option( 'maxNumberOfDays' ); ?>" min="1" class="inputCalc" id="maxNumberOfDays"  placeholder="Number of days" value="1" disabled>
                </div>
            </div>
            <div class="personWrap">
                <label class="labelPeople">Number of people</label>
                <input type="number" max="<?php echo get_option( 'maxNumberOfPeople' ); ?>" min="1" class="inputCalc" id="numberOfPersons"  placeholder="Number of persons" value="1">
            </div>
        </div>
        <div class="rside">
            <div class="totalsWrap">
                <div class="perPerson">
                    <span id="perPersonTotals">$0.00</span>
                    <p>per person</p>
                </div>
                <div class="perPerson">
                    <span id="totalT">$0.00</span>
                    <p>totals</p>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
