package com.agu.learnc.App.View;

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.transition.TransitionManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import com.agu.learnc.R;


public class Login extends Fragment {
    private AppCompatActivity main;
    private boolean showPassword = false;
    public Login(AppCompatActivity main) {
        this.main = main;
    }
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fm_login, container, false);
        return view;
    }

}