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



/* Now only one request */

/*

2 args
1st - url - na ipapasa ung value dun sa 2nd parameter na function
2nd - function - that will run 

results - has all the data that we create on our custom JSON API route 
- check the /inc/search-route.php 
- results name ay pwedeng kahit ano

pangatlong revision na to ng code kaya ung mga early explain e nasa baba commented out na
*/
$.getJSON( universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val(), (results) => {

this.resultsDiv.html(`

<div class="row">
    <div class="one-third">
        <h2 class="search-overlay__section-title"> General Information</h2>

        ${ results.generalInfo.length ? '<ul class="link-list min-list">' : '<p> No general information for that result. </p>'   }

        ${ results.generalInfo.map(

        item => `
        <li> <a href="${ item.permalink }"> ${ item.title } </a>

            ${item.postType == 'post' ? `by ${item.authorName}` : '' } </li>`).join('') }

        ${results.length ? '</ul>' : '' }


    </div>
    <div class="one-third">
        <h2 class="search-overlay__section-title">Programs</h2>

        ${ results.programs.length ? '<ul class="link-list min-list">' : `<p> No programs match that search  </p> <a href="${ universityData.root_url }/programs" > view all programs </a> `   }

        ${ results.programs.map(

        item => `
        <li> <a href="${ item.permalink }"> ${ item.title } </a> `).join('') }

            ${results.length ? '</ul>' : '' }


        <h2 class="search-overlay__section-title">Professors</h2>



        ${ results.professors.length ? '<ul class="professor-cards">' : '<p> No professors information for that result. </p>'   }

        ${ results.professors.map(

        item => ` 
        <li class="professor-card__list-item">
            <a class="professor-card" href="${item.permalink}">
                <img src="${item.image}" alt="" class="professor-card__image">
                <span class="professor-card__name">${item.title}</span>
            </a>
        </li>

        `).join('') }

        ${results.length ? '</ul>' : '' }


    </div>
    <div class="one-third">

        <h2 class="search-overlay__section-title"> Campuses </h2>

        ${ results.campuses.length ? '<ul class="link-list min-list">' : `<p> No campus for that result.<a href="${ universityData.root_url }/campuses" > view all campuses </a> </p> `   }

        ${ results.campuses.map(

        item => `
        <li> <a href="${ item.permalink }"> ${ item.title } </a> `).join('') }

            ${results.length ? '</ul>' : '' }

        <h2 class="search-overlay__section-title" > Events </h2>

        ${ results.events.length ? '' : `<p> No events match that search  </p> <a href="${ universityData.root_url}/events" > view all events </a> `   }

        ${ results.events.map(

        item => `
        <div class="event-summary">
            <a class="event-summary__date t-center" href="${item.permalink}">
                <span class="event-summary__month">                
                    ${item.month}
                </span>

                <span class="event-summary__day">
                    ${item.day}
                </span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny">
                    <a href="${item.permalink}">${item.title}</a></h5>
                <p>
                        ${item.description}            
    <a href="${item.permalink}" class="nu gray">Learn more</a></p>
            </div>
        </div>

        `).join('') }

        ${results.length ? '</ul>' : '' }
</div>
</div>

`);
this.isSpinnerVisible = false;

});



}




/*
So we dont need to worry about the Synchronous 

versus asynchronous topic because we no longer need
to make multiple get JSON requests
no need to create $.when() and $.then() combo
*/

/*---BELOW THIS IS OLD CODE
and andito ung mga Legends explaination about mga code sa taas din

*/
/*
f15v61
Asynchronous

1. $.when() - we can put as many JSON request as we want
and it will run Asynchronously it will wait to complete
before calling the then()
then() - a call back
$.when(a,b,c) then(a,b,c) = sa when ung first argument e mangyayare sa 1st function
ng $.then(), so sa 2nd ng $.when() sa 2nd din ng $.then(), and so on.
2. normally ang argument daw ng  $.getJSON(url, function)
how ever in this $.when().$.then() 
since we got the $.when() method that is baby sitting these request and 
its going automatically pass on their results as parameter
into our $.then() method. and since thats the case we dont need to provide a 
callback function on $.getJSON() method
3. $.then() method can have a 2nd argument to detect an error

----    f16v66 - babaguhin ung code ----------------------  */
//        $.when(
//
//            $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val() ),
//
//
//            $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val() )
//
//        ).then( (posts, pages) => {
//            

/*-------- f16v66 - babaguhin ung code----------------------*/


/* 
posts[0] - kaya nilagyan ng [0] -- para daw dun lang tayo tumingin
sa actual data na galing sa JSON request - kasi array sya marami ring laman
- ung ibang laman daw ng posts[] is whether its succeded or failed
ganun din sa pages[0]
*/

/*-------- f16v66 - babaguhin ung code----------------------*/
/*
var combinedResults = posts[0].concat(pages[0]);
*/
/*-------- f16v66 - babaguhin ung code----------------------*/



/*
andun sa baba ung maraming comment ung explaination
*/            

/*
VERY POWERFUL
${ item.type == 'post' }
san daw makikita ung item.type ? dun sa Json, tignan dun sa browser
makikita dun ung type 
*/

/*-------- f16v66 - babaguhin ung code----------------------*/
/*            this.resultsDiv.html(`

<h2 class="search-overlay__section-title"> General Information </h2>

${ combinedResults.length ? '<ul class="link-list min-list">' : '<p> No general information for that result. </p>'   }

    ${ combinedResults.map( item => `<li> <a href="${ item.link }"> ${ item.title.rendered } </a>

    ${item.type == 'post' ? `by ${item.authorName}` : '' } </li>`).join('') }

    ${combinedResults.length ? '</ul>' : '' }


`);*/
/*-------- f16v66 - babaguhin ung code----------------------*/

/* 2nd argument ng then $.then() */



/*-------- f16v66 - babaguhin ung code----------------------*/
/*     }, ()=>{
this.resultsDiv.html('<p> Unexpected error; Please try again.')
    })



    this.isSpinnerVisible = false;

    }

    */

    /*-------- f16v66 - babaguhin ung code----------------------*/





    // -------------------------------------------------------------------------
    /*----------- Vid 50 onwards OLD Strategy ng pag handle ng JSON Request */
    // -----------A   Synchronous Strategy -------
    // -------------------------------------------------------------------------

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
    //    $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
    //
    //        $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {
    //
    //            var combinedResults = posts.concat(pages);
    //
    //            this.resultsDiv.html(`
    //
    //<h2 class="search-overlay__section-title"> General Information </h2>
//
//${combinedResults.length ? '<ul class="link-list min-list">' : '<p> No general information for that result. </p>'   }
    //
    //${combinedResults.map(item => `<li> <a href="${item.link}"> ${item.title.rendered} </a></li>`).join('') }
    //
    //${combinedResults.length ? '</ul>' : '' }
//
//
//`);
//        })
//
//
//
//        this.isSpinnerVisible = false;
//    }) /* getJSON */
//} /*getResults*/

// -------------------------------------------------------------------------
/*----------- Vid 50 onwards OLD Strategy ng pag handle ng JSON Request */
// -------------------------------------------------------------------------










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
    
    
        /* this will prevent the default behavior of a link elements */
    return false;
}

// ---------------------------------------------------
    
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

    
// ---------------------------------------------------
    /*
    The HTML for Search Overlay
    */
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