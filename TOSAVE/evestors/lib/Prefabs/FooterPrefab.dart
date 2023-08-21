import 'package:evestors/activities/BlankPage.dart';
import 'package:evestors/activities/InversionsActivityPage.dart';
import 'package:evestors/activities/IversorsPageActivity.dart';
import 'package:evestors/activities/MainActivity.dart';
import 'package:evestors/activities/StartUpDetailActivity.dart';
import 'package:evestors/activities/StartUps.dart';
import 'package:evestors/activities/BlankPage.dart';
import 'package:evestors/activities/daos/StartUpDao.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../Utils/AccessNavigator.dart';
import '../Utils/DefaultColors.dart';
import '../activities/FoldersActivity.dart';
import '../activities/startUp/StartupInitialActivity.dart';
import 'ButtonPrefab.dart';
import 'IconsPrefab.dart';

class FooterPrefab {
  Widget defaultFooter(BuildContext context, index) {
    List<IconData> icons = [
      Icons.home,
      Icons.archive,
      Icons.folder,
      Icons.lightbulb,
      Icons.bar_chart
    ];
    List<Function()> functions = [
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(context, MainActivity());
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, StartupInitialActivity());
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, FolderActivity(startUpId: 0, startUpName: ""));
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, StartUpsPageActivity());
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, InversionsActivityPage());
      }
    ];
    return Container(
      margin: const EdgeInsets.only(bottom: 10.0),
      decoration: BoxDecoration(
          border:
              Border(top: BorderSide(width: 4, color: DefaultColors.primary))),
      child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: setSelectedUse(icons, index, functions)),
    );
  }

  Widget defaultStartUpFooter(
      BuildContext context, int index, String startupTitle, int startUpId) {
    List<IconData> icons = [
      Icons.lightbulb,
      Icons.folder,
      Icons.person,
      Icons.close,
      Icons.close
    ];
    List<Function()> functions = [
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(context,
            StartUpDetailActivity(title: startupTitle, startUpId: startUpId));
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(context,
            FolderActivity(startUpId: startUpId, startUpName: startupTitle));
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context,
            InversorsPageActivity(
                startUpId: startUpId, startUpName: startupTitle));
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, StartUpsPageActivity());
      },
      () {
        AccessNavigator.accessAndReplaceToNoAnimation(
            context, BlankPageActivity());
      }
    ];
    return Container(
      margin: const EdgeInsets.only(bottom: 10.0),
      decoration: BoxDecoration(
          border:
              Border(top: BorderSide(width: 4, color: DefaultColors.primary))),
      child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: setSelectedUse(icons, index, functions)),
    );
  }

  List<Widget> setSelectedUse(List icons, index, functions) {
    List<Widget> selectedIcons = [];
    int _inIndex = 0;
    Widget createdWidged = Container();
    icons.forEach((element) {
      if (_inIndex == index) {
        createdWidged = ButtonPrefab.defaultIconButton(
            Icon(icons[_inIndex], color: DefaultColors.primary),
            functions[_inIndex]);
      } else {
        createdWidged = ButtonPrefab.defaultIconButton(
            Icon(icons[_inIndex], color: DefaultColors.black),
            functions[_inIndex]);
      }
      selectedIcons.add(createdWidged);
      _inIndex++;
    });
    return selectedIcons;
  }
}
