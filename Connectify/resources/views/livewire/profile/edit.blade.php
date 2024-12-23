<div>
    @php
        if($username !== $_SESSION['username']) return redirect('/profile/'.$_SESSION['username'].'/edit');
    @endphp
</div>
