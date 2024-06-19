<div class="language-picker js-language-picker" data-trigger-class="bg-white text-gray-900 shadow-md text-[1em] px-4 py-2 rounded-md relative inline-flex justify-center items-center whitespace-nowrap cursor-pointer no-underline leading-tight transition-all duration-200 hover:shadow focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-700 js-tab-focus">
    <form  action="" method="post" class="language-picker__form">
        @csrf
        <label for="language-picker-select">Select your language</label>
        <select name="language-picker-select" id="language-picker-select" >
            <option lang="lang" value="tm" @if($current_locale === 'tm') selected @endif >Tm</option>
            <option lang="lang" value="en" @if($current_locale === 'en') selected @endif>En</option>
            <option lang="lang" value="ru" @if($current_locale === 'ru') selected @endif>Ru</option>
        </select>
    </form>
</div>