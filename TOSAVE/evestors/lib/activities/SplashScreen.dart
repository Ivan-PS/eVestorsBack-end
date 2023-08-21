import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/activities/LoginAvtivity.dart';
import 'package:evestors/activities/MainActivity.dart';
import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'daos/UserDao.dart';

class SplashActivity extends StatefulWidget {
  const SplashActivity({super.key});

  @override
  State<SplashActivity> createState() => SplashActivityState();
}

class SplashActivityState extends State<SplashActivity> {
  @override
  void initState() {
    checkIfUserLogin();
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(body: LoginActivity());
  }

  void checkIfUserLogin() async {
    UserDao saveUser = await LocalPreferences().getSavedUser();
    if (saveUser.sessionToken != "") {
      AccessNavigator.accessAndReplaceTo(context, MainActivity());
    } else {
      AccessNavigator.accessAndReplaceTo(context, LoginActivity());
    }
  }
}
