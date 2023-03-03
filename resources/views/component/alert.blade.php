@if (Session::get('gagal'))
<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
  </div>
@endif
