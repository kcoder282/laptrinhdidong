package com.agu.learnc.App.View;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.transition.TransitionManager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.RadioGroup;
import android.widget.TextView;

import com.agu.learnc.App.Static;
import com.agu.learnc.R;

public class Info extends Fragment {

    AppCompatActivity main;
    boolean showPassword = false;
    public Info(AppCompatActivity main) {
        this.main = main;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fm_info, container, false);
        ((EditText)view.findViewById(R.id.info_name)).setText(Static.user.getFullname());
        ((EditText)view.findViewById(R.id.info_birth)).setText(Static.user.getBird());
        ((EditText)view.findViewById(R.id.info_email)).setText(Static.user.getEmail());
        String name = "Hi, " + Static.user.getName() + " (" + (Static.user.getType()==1?"Admin":"Normal") +")";
        ((TextView)view.findViewById(R.id.info_username)).setText(name);
        ((RadioGroup)view.findViewById(R.id.info_sex))
                .check((Static.user.getSex()==1?R.id.info_sex_male:R.id.info_sex_female));
        view.findViewById(R.id.admin_user_manager).setVisibility((Static.user.getType()==1?View.VISIBLE:View.GONE));
        return view;
    }
    public void showPassword(boolean show){
        if(showPassword != show)
        {
            this.showPassword = show;
            TextView txt = main.findViewById(R.id.text_show_password);
            TransitionManager.beginDelayedTransition((ViewGroup) txt.getParent().getParent());
            if(show)
            {
                main.findViewById(R.id.info_show_password).setVisibility(View.VISIBLE);
                txt.setCompoundDrawablesRelativeWithIntrinsicBounds(R.drawable.ic_arrow_drop_up,0,0,0);
            }else{
                main.findViewById(R.id.info_show_password).setVisibility(View.GONE);
                txt.setCompoundDrawablesRelativeWithIntrinsicBounds(R.drawable.ic_arrow_drop_down,0,0,0);
            }
        }
    }

    public void toggle() {
        showPassword(!this.showPassword);
    }
}