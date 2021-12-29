package com.agu.learnc;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.graphics.drawable.AnimationDrawable;
import android.os.Bundle;
import android.text.Editable;
import android.transition.Fade;
import android.transition.TransitionManager;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.agu.learnc.API.ApiService;
import com.agu.learnc.Model.User;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {
    String TAG = "check";
    private int select = R.id.home;
    private int[][] menu = new int[4][2];
    public static User user = null;
    private FragmentManager fragmentManager = null;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        fragmentManager = this.getFragmentManager();
        menu[0][0] = R.id.home;
        menu[0][1] = R.id.home_text;
        menu[1][0] = R.id.lesson;
        menu[1][1] = R.id.lesson_text;
        menu[2][0] = R.id.code;
        menu[2][1] = R.id.code_text;
        menu[3][0] = R.id.user;
        menu[3][1] = R.id.user_text;

    }

    public void changeSelect(View view) {
       if(select != view.findViewWithTag("icon").getId())
       {
           select = view.findViewWithTag("icon").getId();
           for(int[] item : menu) {
               Fade f = new Fade();
               f.setDuration(50);
               TransitionManager.beginDelayedTransition((ViewGroup) view);
               ImageView img = findViewById(item[0]);
               TextView txt = findViewById(item[1]);
               if( item[0] == select )
               {
                   img.setScaleX(1.3f);
                   img.setScaleY(1.3f);
                   img.setColorFilter(this.getColor(R.color.primary));
                   txt.setVisibility(View.VISIBLE);
               }else
               {
                   img.setScaleX(1.1f);
                   img.setScaleY(1.1f);
                   img.setColorFilter(this.getColor(R.color.silver));
                   txt.setVisibility(View.GONE);
               }
           }
           LoadSelect(select);
       }
    }

    public void onLogin(View view) {
        changeSelect((View)findViewById(R.id.user).getParent());
    }

    public void LoadSelect(int select)
    {
        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
        Fragment fragment = fragmentManager.findFragmentByTag("content");
        if(fragment != null)
        {
            fragmentTransaction.remove(fragment);
            fragmentTransaction.commit();
        }

        if(select == R.id.user)
        {
            if(MainActivity.user==null)
            {
                fragmentTransaction.add(R.id.contentMain, new Login(), "content");
                fragmentTransaction.commit();
            }else
            {
                fragmentTransaction.add(R.id.contentMain, new Infor(), "content");
                fragmentTransaction.commit();
            }
        }
    }
    public void onSubmitLogin(View btn)
    {

        View view = this.getCurrentFocus();
        if (view != null) {
            InputMethodManager imm = (InputMethodManager)getSystemService(INPUT_METHOD_SERVICE);
            imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
        }
        String username = ((EditText)findViewById(R.id.username_input)).getText().toString();
        String password = ((EditText)findViewById(R.id.password_input)).getText().toString();
        ApiService.api.Login(username, password).enqueue(new Callback<User>() {
            @Override
            public void onResponse(Call<User> call, Response<User> response) {
                if(response.code()==200)
                {
                    MainActivity.user = response.body();
                    String[] name = response.body().getFullname().split(" ");
                    String show = "Hi "+ name[name.length-1];
                    ((TextView)findViewById(R.id.name_user)).setText(show);
                    changeSelect((View) findViewById(R.id.home).getParent());
                }
            }

            @Override
            public void onFailure(Call<User> call, Throwable t) {
                Toast.makeText(MainActivity.this, "Call Api Error", Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void ChangePassWord(View view) {
        TransitionManager.beginDelayedTransition((ViewGroup) view.getParent());
        if(findViewById(R.id.old_pass).getVisibility() == View.GONE)
        {
            findViewById(R.id.old_pass).setVisibility(View.VISIBLE);
            findViewById(R.id.new_pass).setVisibility(View.VISIBLE);
            findViewById(R.id.config_pass).setVisibility(View.VISIBLE);
            TextView txt = (TextView) view;
            txt.setCompoundDrawablesWithIntrinsicBounds(R.drawable.ic_arrow_drop_up,0,0,0);
        }else
        {
            findViewById(R.id.old_pass).setVisibility(View.GONE);
            findViewById(R.id.new_pass).setVisibility(View.GONE);
            findViewById(R.id.config_pass).setVisibility(View.GONE);
            TextView txt = (TextView) view;
            txt.setCompoundDrawablesWithIntrinsicBounds(R.drawable.ic_arrow_drop,0,0,0);
        }
    }
}