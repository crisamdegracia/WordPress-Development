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
        this.openButton     =  $('.js-search-trigger');
        this.closeButton    =  $('.search-overlay__close');
        this.searchOverlay  =  $('.search-overlay');
        this.searchField    =  $('#search-term');
        this.typingTimer;
        //so it will run
        // basically the logic can be in events - 
        // 
        this.events();
        
        
        //checking the search=S-83 and esc=27
        this.isOverlayOpen = false;
    }


    // ---------------------------------------------------
    // 2. Events 
    events() {
        //ung .bind(this) daw is will create blah blah .
        // ewan ko dko maintindihan haha
        // so ngayon, in this method pag nag click dun sa fron-end
        // ung open button, then ang first line dito ung tatawagin
        // tapos naman pag click nung close button matitrigger ung 
        // closeOverlay() na function.

        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));

        $(document).on('keyup', this.keyPressDispatcher.bind(this));
        this.searchField.on('keydown', this.typingLogic.bind(this));
    }


    // ---------------------------------------------------
    // 3. Methods ( function, action...)
    //f13v53 - 12:40
    
    typingLogic() {
        
        //clearing or resetting the timer
        //makinig ka! kung sino kaman! 
        //hindi ko naintindihan ung explaination! :D
        //pero basta ang mangyayare daw
        // kapag type nya between 2mili seconds
        //dun palang gagana ung function sa setTimeout (EWAANNNN!);
        // kung wala tong cleartimout mag titrigger kada press ng keyword sa input field.
        //YON!
        clearTimeout( this.typingTimer );
    this.typingTimer = setTimeout(function(){console.log('pisit')}, 2000); 
    }
    
    
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

    keyPressDispatcher(e){
        
        //doble checking - 
        //1st check - kung ung napressed is 'S'
        //2nd check - kung naset ba ni openOverlay() and closeOverlay()
        // kung false or true
        if(e.keyCode == 83 &&  !this.isOverlayOpen ){
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