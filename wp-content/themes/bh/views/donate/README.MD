# Donation Pages
## iCount Documentation
### CSS
~~~~
@import url(//fonts.googleapis.com/earlyaccess/opensanshebrew.css);

* {
    font-family: Open Sans Hebrew, sans-serif;
}

#main-wrapper {
    margin: 0 auto;
    padding: 0;
}

#product-multilines,
#header-section,
#page-totalwithvat-title,
#flags,
#client_box,
#product-price-section-one,
#second_ttl{
    display:none;
}

#product-price-section-two {
    min-width: 100%
}

#form-details-section {
    text-align: center;
}

#page-totalwithvat {
    font-size: 50px;
}

.box {
   display: inline-block;
   float: initial;
   width: 540px;
   margin: 0;
}

.iShadow,
.iShadow-small {
    box-shadow: none;
    background-color: #ffffff;
}

.box_title {

    font-size: 22px;
    background-color: #daf3f6;
    background-image: none;
    border: none;
    margin: 15px 20%;
    padding: 10px 20px;
    color: #666;
    height: auto;
}

.box_contents {
    padding:0;
}

input {
   box-sizing: border-box;
}

textarea, input[type=text], input[type=number], select, 
textarea:hover, input[type=text]:hover, input[type=number]:hover, select:hover {
    border: 3px solid #fee2b6;
    border-radius: 0;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    margin-top: 5px;
}

input#cccardnumber {
    width: 100% !important;
}

.cleanul li {
    margin-bottom: 15px;
}

.mandatory_asterisk, label {
    line-height: 23px;
    font-size: 16px;
    color: #666;
    font-weight: 400;
}

#paynow-container {
    width: 100%;
    text-align: center;
}

.greenBTN,
.greenBTN:active,
.greenBTN:hover {
    border-radius: 0;
    border: none;
    text-align: center;
    color: #FFF;
    width: auto;
    font-size: 30px;
    height: 50px;
    line-height: 50px;
    padding: 0 10%;
    background: -webkit-gradient(linear, left top, left bottom, from(#fbb034), to(#fbb034));
    background: -moz-linear-gradient(top, #fbb034, #fbb034);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#fbb034, endColorstr=#fbb034);
}

@media (max-width: 480px) {
   .box {
      width:100%;
   }

   .box_title {
      margin: 15px;
   }

   .box_contents {
      padding: 0 15px;
   }

   .greenBTN {
      margin: 0 15px;
      font-size: initial;
   }
}
~~~~