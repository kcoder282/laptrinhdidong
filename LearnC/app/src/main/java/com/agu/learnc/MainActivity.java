package com.agu.learnc;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.Toast;

import com.agu.learnc.App.Controller.HomeController;
import com.agu.learnc.App.Static;
import com.agu.learnc.App.View.Info;
import com.agu.learnc.App.View.Login;

public class MainActivity extends AppCompatActivity {

    HomeController home;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        home = new HomeController(this);
        Static.sharedPreferences = getSharedPreferences("Data_Local_of_LearnC", MODE_PRIVATE);
        Static.key = Static.GetString("key");
        home.getLogin();
    }

    public void changeMenu(View view) {
        home.ChangeTag(view);
    }

    public void exec_Login(View btn) {
        home.login(btn);
    }

    public void showChangeData(View view) {
        ((Info)Static.content).toggle();
    }

    public void SignOut(View view) {
        home.sign_out();
    }

    public void ManagerUser(View view) {
    }

    public void changeUser(View view) {
        changeMenu(findViewById(R.id.menu_user));
    }
    public void changeHome(View view) {
        changeMenu(findViewById(R.id.menu_home));
    }
}