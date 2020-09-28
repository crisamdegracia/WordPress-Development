import $ from 'jquery';

class Search {
    // 1. describe and create/initiate our object
    // constructor will be first to call in order
    // then when calling the first method 
    // the events method will be called
    // kaya pa?
    //ung js-search-trigger is nasa header.php
    // ang pag kakaintindi ko is dito sa contructor ung mga 
    // variables - tapos at the end this.events() will call them
    // they are called property
    constructor(){
        this.resultsDiv     = $('#search-overlay__results');
        this.openButton     = $('.js-search-trigger');
        this.closeButton    = $('.search-overlay__close');
        this.searchOverlay  = $('.search-overlay');
        this.searchField    = $('#search-term');
        this.typingTimer;

        //so we can avoid the spinner load if
        //we press arrow keys
        this.previousValue;


        //so it will run
        // basically the logic can be in events - 
        // 
        this.events();


        //checking the search=S-83 and esc=27
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
    }


    // ---------------------------------------------------
    // 2. Events 
    events() {
        //ung .bind(this) daw is will create blah blah .
        // ewan ko dko maintindihan haha
        // so ngayon, in this method pag nag click dun sa fron-end
        // ung openButton, then ang first line dito ung tatawagin
        // tapos naman pag click nung closeButton matitrigger ung 
        // closeOverlay() na function.

        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));

        $(document).on('keyup', this.keyPressDispatcher.bind(this));

        // so ngayon chinange nya from keydown to keyup
        //kasi daw ung keydown wala daw time na mag update ung data
        // pagtype ng user. so kung key-up my miliseconds na time 
        //pra makapag update c JS
        this.searchField.on('keyup', this.typingLogic.bind(this));
    }


    // ---------------------------------------------------
    // 3. Methods ( function, action...)
    //f13v53 - 12:40

    typingLogic() {


        // ang una pala mangyare, ichecheck muna netong condition kung
        // ung naka typed sa search field is same value 
        // bago ideclare na kung gagana naba ung spinner


        if(this.searchField.val() != this.previousValue ) {

            //clearing or resetting the timer
            //makinig ka! kung sino kaman! 
            //hindi ko naintindihan ung explaination! :D
            //pero basta ang mangyayare daw
            // kapag type nya between 2mili seconds
            //dun palang gagana ung function sa setTimeout (EWAANNNN!);
            // kung wala tong cleartimout mag titrigger kada press ng keyword sa input field.
            //YON!

            //ung .bind(this) daw is para maacess natin ung method na getResults

            // bago mangyare lahat, iclearTimeout muna ung logic ng
            // typing timer
            clearTimeout( this.typingTimer );

            //if the field is not blank
            if(this.searchField.val() ){

                //tapos dito icheck nya kung false ba ung spinner which is the defaault
                // kapg false so this condition will proceed
                if(!this.isSpinnerVisible){

                    //tapos ung spinner mag iikot ikot sya dun sa front-end
                    this.resultsDiv.html('<div class="spinner-loader"> </div>')
                    //after that ise-set to true.
                    this.isSpinnerVisible = true;
                }
                // this will set a value for 
                this.typingTimer = setTimeout(this.getResults.bind(this),1400); 

            } else {

                // so ngayong kung blank sya, the result div
                // will be blank
                // and the spinner will be set to false
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;

            }




        }



        this.previousValue = this.searchField.val();
    }
    // ---------------------------------------------------

    getResults() {

        this.resultsDiv.html('What the heeell');


        // setting this para kapag run ng method sa taas ^
        // gagana parin ung spin loader.
        // this is a logic DON'T Forget!
        this.isSpinnerVisible = false; 
    }

    // ---------------------------------------------------
    openOverlay(){

        this.searchOverlay.addClass('search-overlay--active');
        $('body').addClass('body-no-scroll');
        this.isOverlayOpen = true;
    }

    closeOverlay(){
        this.searchOverlay.removeClass('search-overlay--active');
        $('body').removeClass('body-no-scroll');
        this.isOverlayOpen = false;

    }


    // ---------------------------------------------------
    keyPressDispatcher(e){

        //doble checking - 
        //1st check - kung ung napressed is 'S'
        //2nd check - kung naset ba ni openOverlay() and closeOverlay()
        // kung false or true
        
        // 3rd args - we will make sure that in input field and textarea field
        // the hasnt not click or focus the field 
        if(e.keyCode == 83 &&  !this.isOverlayOpen && !$("input, textarea").is(':focus')){
            this.openOverlay();
            console.log('close ba?')

        }

        if(e.keyCode == 27 &&  this.isOverlayOpen ){
            this.closeOverlay();
            console.log('open ba?')

        } 
    }
}


export default Search;