<form role="search" method="get" class="search-form" action="http://storefront.local/">
    <label>        
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.8428 14.0854L10.8753 10.1179C11.7759 9.04651 12.321 7.66641 12.321 6.16049C12.321 2.76363 9.55751 0 6.16049 0C2.76363 0.000669566 0 2.76415 0 6.161C0 9.55786 2.76346 12.3215 6.16049 12.3215C7.66644 12.3215 9.04651 11.7764 10.1179 10.8758L14.0854 14.8433C14.1899 14.9478 14.3271 15 14.4644 15C14.6017 15 14.7389 14.9478 14.8434 14.8433C15.053 14.6337 15.053 14.2956 14.8434 14.086L14.8428 14.0854ZM1.07161 6.16117C1.07161 3.35554 3.35493 1.07206 6.16073 1.07206C8.96653 1.07206 11.2498 3.35537 11.2498 6.16117C11.2498 8.96697 8.96653 11.2503 6.16073 11.2503C3.35493 11.2503 1.07161 8.96697 1.07161 6.16117Z" fill="black"/>
        </svg>
        <input type="search" class="search-field" placeholder="SEARCH HERE"  value="<?php echo get_search_query(); ?>" name="s" >
    </label>
    <input type="submit" class="search-submit" value="Search" hidden>
</form>