//User Can purchase after the login Through this code we can get back to the same page where we want to purchase 


@if(Auth::check())
<button class="thm-btn pricing-one__btn" type="button" onclick="submitForm({{ $membership->amount }}, {{ $membership->id }})" id="proceedToPay">Purchase Now <span class="icon-right-arrow"></span></button>
@else
//here we send an action with route 
<a href="{{route('mylogin')}}?action=m" class="thm-btn pricing-one__btn">Purchase Now <span class="icon-right-arrow"></span></a>
@endif


//Now in login page we create an hidden input where we can get the action 
<input type="hidden" name="pagetype" value="{{request()->action ?? ''}}">

//Now here we handle the action request
public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            if($request->has('pagetype') && $request->pagetype == 'm') {
                return redirect()->route('membership');    
            }
            return redirect()->intended('/');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
