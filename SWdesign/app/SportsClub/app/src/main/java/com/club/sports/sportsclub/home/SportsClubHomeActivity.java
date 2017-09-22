package com.club.sports.sportsclub.home;

import android.app.TabActivity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;

import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TabHost;
import android.widget.TextView;

import com.club.sports.sportsclub.R;
import com.club.sports.sportsclub.back.BackPressCloseHandler;
import com.club.sports.sportsclub.tab.TabContestInfoActivity;
import com.club.sports.sportsclub.tab.TabGroupActivity;
import com.club.sports.sportsclub.tab.TabMyInfoActivity;
import com.club.sports.sportsclub.tab.TabRankActivity;
import com.club.sports.sportsclub.tab.TabSettingActivity;

/**
 * Created by again on 2017-09-12.
 */

public class SportsClubHomeActivity extends TabActivity {

    private static final int CONTEST = 0;
    private static final int GROUP = 1;
    private static final int RANK = 2;
    private static final int MY_INFO = 3;
    private static final int SETTING = 4;
    private static final float FONT_SIZE = 9.0f;

    private BackPressCloseHandler mBackPressCloseHandler;
    private TabHost mTabHost;
    private TabHost.TabSpec mSpec;
    private Intent mIntent;
    private ImageView mTopLogoImageView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sportsclub_home);

        initialize();
    }

    private void initialize() {
        mBackPressCloseHandler = new BackPressCloseHandler(this);
        findView();
        initializeTab();
        onClickTopLogoImageView();
    }

    private void findView() {
        mTopLogoImageView = (ImageView) findViewById(R.id.top_logo);
    }

    private void initializeTab() {
        mTabHost = getTabHost();

        applyIntentContest();
        applyIntentGroup();
        applyIntentRank();
        applyIntentMyInfo();
        applyIntentSetting();
        applyIntentTextColor();
        setTabTextViewColor(CONTEST);

        startTabChanged();
    }

    private void onClickTopLogoImageView() {
        mTopLogoImageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mIntent = new Intent().setClass(SportsClubHomeActivity.this, SportsClubHomeActivity.class);
                startActivity(mIntent);
                finish();
            }
        });
    }

    private void applyIntentContest() {
        mIntent = new Intent().setClass(this, TabContestInfoActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.contest_name)).setIndicator(getResources().getString(R.string.contest_info)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentGroup() {
        mIntent = new Intent().setClass(this, TabGroupActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.group_naem)).setIndicator(getResources().getString(R.string.group)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentRank() {
        mIntent = new Intent().setClass(this, TabRankActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.rank_name)).setIndicator(getResources().getString(R.string.rank)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentMyInfo() {
        mIntent = new Intent().setClass(this, TabMyInfoActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.my_info_name)).setIndicator(getResources().getString(R.string.my_info)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentSetting() {
        mIntent = new Intent().setClass(this, TabSettingActivity.class);
        mSpec = mTabHost.newTabSpec(getResources().getString(R.string.setting_name)).setIndicator(getResources().getString(R.string.setting)).setContent(mIntent);
        mTabHost.addTab(mSpec);
    }

    private void applyIntentTextColor() {
        for (int i = 0; i < getTabWidget().getChildCount(); i++) {
            TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(i).findViewById(android.R.id.title);
            textView.setTextColor(Color.BLACK);
            textView.setTextSize(FONT_SIZE);
        }
    }

    private void startTabChanged() {
        mTabHost.setOnTabChangedListener(new TabHost.OnTabChangeListener() {
            @Override
            public void onTabChanged(String tabId) {
                findTabChanged(tabId);
            }
        });
    }

    private void findTabChanged(String tabId) {
        switch (tabId) {
            case "Contest":
                applyIntentTextColor();
                setTabTextViewColor(CONTEST);
                break;
            case "Group":
                applyIntentTextColor();
                setTabTextViewColor(GROUP);
                break;
            case "Rank":
                applyIntentTextColor();
                setTabTextViewColor(RANK);
                break;
            case "MyInfo":
                applyIntentTextColor();
                setTabTextViewColor(MY_INFO);
                break;
            case "Setting":
                applyIntentTextColor();
                setTabTextViewColor(SETTING);
                break;
        }
    }

    private void setTabTextViewColor(int index) {
        TextView textView = (TextView) mTabHost.getTabWidget().getChildAt(index).findViewById(android.R.id.title);
        textView.setTextColor(Color.RED);
    }

    @Override
    public void onBackPressed() {
        mBackPressCloseHandler.onBackPressed();
    }
}