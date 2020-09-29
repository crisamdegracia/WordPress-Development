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

    // addSearchHTML is where our search resides
    constructor(){
        this.addSearchHTML();
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
                this.typingTimer = setTimeout(this.getResults.bind(this), 500); 

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
        // universityData.root_url - we can see its value inside functions.php
        // ^ this is very powerful!
        // setting this para kapag run ng method sa taas ^
        // gagana parin ung spin loader.
        // this is a logic DON'T Forget!
        // was hidden because this is the ealier video
        // this.isSpinnerVisible = false; 


        //map() can have access to the array and create new version
        // inside map() is a function that will run in each item
        // but its output will have commas(',')
        // so we use join()
        // join() is JS on how we can convert an array to a simple string
        // inside join is a character betwenn the item join( x - >  ,)
        // we can also put join('')  so the output is just blank


        //ternary operator - that can work inside template literal
        // a ternary operator is short way of creating conditional logic
        // ternary - 1st args condition a tru or false
        // ternary - 2nd arg function you want to run
        // ternary - 3rd a function when the condition is false
        // $posts.length - will check if the search field has value 
        // as soon all the code run -- isSpinnerVisible = false
        // posts.concat() - to combine multiple array
        $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
            
            $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {
                
                var combinedResults = posts.concat(pages);
                
                this.resultsDiv.html(`

<h2 class="search-overlay__section-title"> General Information </h2>

${combinedResults.length ? '<ul class="link-list min-list">' : '<p> No general information for that result. </p>'   }

${combinedResults.map(item => `<li> <a href="${item.link}"> ${item.title.rendered} </a></li>`).join('') }

${combinedResults.length ? '</ul>' : '' }


`);
            })



            this.isSpinnerVisible = false;
        }) /* getJSON */
    } /*getResults*/

    // ---------------------------------------------------
    openOverlay(){

        // adding class to active the div on search
        this.searchOverlay.addClass('search-overlay--active');

        //adding class to the body so the user wont be able to scroll 
        //during search
        $('body').addClass('body-no-scroll');

        //setting search field empty on open
        this.searchField.val(''); 

        //set time out delay to let it load 1st before adding the focus
        setTimeout( () => this.searchField.focus() ,301)

        // condition for checking
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

    addSearchHTML(){
        $('body').append(`
<div class="search-overlay ">
<div class="search-overlay__top">
<div class="container">
<i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
<input id="search-term" type="text" placeholder="What are you looking for?" class="search-term">
<i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>

</div>
</div>

<div class="container">
<div id="search-overlay__results">

</div>
</div>
</div>
`)
    }
}


export default Search;