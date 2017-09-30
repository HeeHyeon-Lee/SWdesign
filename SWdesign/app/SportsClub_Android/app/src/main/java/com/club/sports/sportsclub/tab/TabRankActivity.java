package com.club.sports.sportsclub.tab;

import android.graphics.Color;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;

/**
 * Created by again on 2017-09-23.
 */

public class TabRankActivity extends AppCompatActivity {

    private BackPressCloseHandler mBackPressCloseHandler;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        setContentView(R.layout.sprotsclub_rank);
    }

    @Override
    public void onBackPressed(){
        mBackPressCloseHandler.onBackPressed();
    }
}
