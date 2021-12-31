package com.agu.learnc.App.Controller;

import android.content.Context;
import android.transition.TransitionManager;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.agu.learnc.Api.ApiManager;
import com.agu.learnc.App.Model.User;
import com.agu.learnc.App.Static;
import com.agu.learnc.App.View.Info;
import com.agu.learnc.App.View.Login;
import com.agu.learnc.R;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class HomeController {
    private int select = R.id.menu_home;
    private AppCompatActivity main;
    private int[] menu = new int[4];
    private FragmentManager load;
    private FragmentTransaction transaction;

    public HomeController(AppCompatActivity main) {
        load = main.getSupportFragmentManager();
        this.main = main;
        menu[0] = R.id.menu_home;
        menu[1] = R.id.menu_lesson;
        menu[2] = R.id.menu_code;
        menu[3] = R.id.menu_user;
    }

    /**
     *  Process when click a item menu
     * @param view item click
     */
    public void ChangeTag(View view){
        if(view.getId() != select)
        {
            select = view.getId();
            TransitionManager.beginDelayedTransition((ViewGroup) view);
            for(int item : menu) {
                LinearLayout layout = main.findViewById(item);
                ImageView img = layout.findViewWithTag("icon");
                TextView txt = layout.findViewWithTag("text");
                if(view.getId() == item){
                    txt.setVisibility(View.VISIBLE);
                    img.setColorFilter(main.getColor(R.color.primary));
                }else{
                    txt.setVisibility(View.GONE);
                    img.setColorFilter(main.getColor(R.color.silver));
                }
            }
            LoadFragment(select);
        }
    }

    /**
     * Load Fragment in data
     * @param select select item
     */
    public void LoadFragment(int select)
    {
//        Remove Fragment
        transaction = load.beginTransaction();
        Fragment fm = load.findFragmentByTag("fm_content");
        if(fm != null)
        {
            transaction.remove(Static.content);
            transaction.commit();
        }
//        Add Fragment with select
        TransitionManager.beginDelayedTransition(main.findViewById(R.id.main_content));
        if(select == R.id.menu_user)
        {
            if(Static.user==null)
            {
                Static.content = new Login(main);
            }else
            {
                Static.content = new Info(main);
            }
            transaction.add(R.id.main_content, Static.content, "fm_content");
            transaction.commit();
        }else
        if(select == R.id.menu_code)
        {
            
        }

    }

    /**
     * Login to server
     * @param view btn login
     */
    public void login(View view) {
        View btn = main.getCurrentFocus();
        if (btn != null) {
            InputMethodManager imm = (InputMethodManager)main.getSystemService(Context.INPUT_METHOD_SERVICE);
            imm.hideSoftInputFromWindow(btn.getWindowToken(), 0);
        }
        TransitionManager.beginDelayedTransition((ViewGroup) view);
        view.findViewWithTag("load").setVisibility(View.VISIBLE);
        String username = ((TextView)main.findViewById(R.id.input_username)).getText().toString();
        String password = ((TextView)main.findViewById(R.id.input_password)).getText().toString();
        ApiManager.call.Login(username, password).enqueue(new Callback<User>() {
            @Override
            public void onResponse(Call<User> call, Response<User> response) {
                if(response.code()==200 && response.body().getId() != -1)
                {
                    Static.user = response.body();
                    String[] listname = Static.user.getFullname().split(" ");
                    String name = "Hi "+ listname[listname.length-1];
                    ((TextView)main.findViewById(R.id.user_name_top)).setText(name);
                    Static.SetString("key", Static.user.getRemember_token());
                    ChangeTag(main.findViewById(R.id.menu_home));
                }else{
                    Toast.makeText(main, "Login Fail.", Toast.LENGTH_SHORT).show();
                    Static.SetString("key", null);
                }
                view.findViewWithTag("load").setVisibility(View.GONE);
            }

            @Override
            public void onFailure(Call<User> call, Throwable t) {
                Toast.makeText(main, "Login Fail.", Toast.LENGTH_SHORT).show();
                view.findViewWithTag("load").setVisibility(View.GONE);
                Static.SetString("key", null);
            }
        });
    }
    public void getLogin()
    {
        if(Static.key != null)
            ApiManager.call.GetUser(Static.key).enqueue(new Callback<User>() {
                @Override
                public void onResponse(Call<User> call, Response<User> response) {
                    if(response.code()==200 && response.body().getId() != -1)
                    {
                        Static.user = response.body();
                        String[] listname = Static.user.getFullname().split(" ");
                        String name = "Hi "+ listname[listname.length-1];
                        ((TextView)main.findViewById(R.id.user_name_top)).setText(name);
                    }else Static.SetString("key", null);
                }

                @Override
                public void onFailure(Call<User> call, Throwable t) {
                    Static.SetString("key", null);
                }
            });
    }

    public void sign_out() {
        Static.user = null;
        Static.SetString("key", null);
        ((TextView)main.findViewById(R.id.user_name_top)).setText("Log in");
        ChangeTag(main.findViewById(R.id.menu_home));
    }
}
