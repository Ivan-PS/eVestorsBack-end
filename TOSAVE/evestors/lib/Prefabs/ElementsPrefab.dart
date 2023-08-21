import 'package:evestors/Prefabs/ButtonPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/Utils/DefaultColors.dart';
import 'package:evestors/activities/StartUpDetailActivity.dart';
import 'package:evestors/activities/daos/StartUpDao.dart';
import 'package:evestors/activities/startUp/DetailFolderActivity.dart';
import 'package:evestors/beans/StartUpBean.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class ElementsPrefab {
  Widget defaultMenuElement() {
    return Padding(
      padding: EdgeInsetsDirectional.fromSTEB(16, 12, 16, 0),
      child: Container(
        width: double.infinity,
        height: 60,
        decoration: BoxDecoration(
          color: DefaultColors.white,
          boxShadow: [
            BoxShadow(
              blurRadius: 5,
              color: Color(0x3416202A),
              offset: Offset(0, 2),
            )
          ],
          borderRadius: BorderRadius.circular(12),
          shape: BoxShape.rectangle,
        ),
        child: Padding(
          padding: EdgeInsetsDirectional.fromSTEB(8, 8, 8, 8),
          child: Row(
            mainAxisSize: MainAxisSize.max,
            children: [
              Icon(
                Icons.attach_money_rounded,
                color: DefaultColors.white,
                size: 24,
              ),
              Padding(
                padding: EdgeInsetsDirectional.fromSTEB(12, 0, 0, 0),
                child: Text(
                  'Payment Options',
                ),
              ),
              Expanded(
                child: Align(
                  alignment: AlignmentDirectional(0.9, 0),
                  child: Icon(
                    Icons.arrow_back_ios_outlined,
                    color: DefaultColors.white,
                    size: 18,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget defaultElementWithImage(
      BuildContext context, String name, String description) {
    return Padding(
      padding: EdgeInsetsDirectional.fromSTEB(0, 1, 0, 0),
      child: Container(
        width: double.infinity,
        decoration: BoxDecoration(
          color: DefaultColors.white,
          boxShadow: [
            BoxShadow(
              blurRadius: 0,
              color: DefaultColors.white,
              offset: Offset(0, 1),
            )
          ],
        ),
        child: Padding(
          padding: EdgeInsetsDirectional.fromSTEB(16, 8, 16, 8),
          child: Row(
            mainAxisSize: MainAxisSize.max,
            children: [
              Card(
                clipBehavior: Clip.antiAliasWithSaveLayer,
                color: DefaultColors.white,
                elevation: 2,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(50),
                ),
                child: Padding(
                  padding: EdgeInsetsDirectional.fromSTEB(2, 2, 2, 2),
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(40),
                    child: Container(),
                  ),
                ),
              ),
              Padding(
                padding: EdgeInsetsDirectional.fromSTEB(16, 0, 0, 0),
                child: Column(
                  mainAxisSize: MainAxisSize.max,
                  mainAxisAlignment: MainAxisAlignment.center,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      name,
                    ),
                    Padding(
                      padding: EdgeInsetsDirectional.fromSTEB(0, 4, 0, 0),
                      child: Text(
                        name,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget defaultElementWithImageOnPress(BuildContext context, String name,
      String description, Function() onPress) {
    return Padding(
      padding: EdgeInsetsDirectional.fromSTEB(0, 1, 0, 0),
      child: GestureDetector(
        onTap: onPress,
        child: Container(
          width: double.infinity,
          decoration: BoxDecoration(
            color: DefaultColors.white,
            boxShadow: [
              BoxShadow(
                blurRadius: 0,
                color: DefaultColors.white,
                offset: Offset(0, 1),
              )
            ],
          ),
          child: Padding(
            padding: EdgeInsetsDirectional.fromSTEB(16, 8, 16, 8),
            child: Row(
              mainAxisSize: MainAxisSize.max,
              children: [
                Card(
                  clipBehavior: Clip.antiAliasWithSaveLayer,
                  color: DefaultColors.white,
                  elevation: 2,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(50),
                  ),
                  child: Padding(
                    padding: EdgeInsetsDirectional.fromSTEB(2, 2, 2, 2),
                    child: ClipRRect(
                      borderRadius: BorderRadius.circular(40),
                      child: Container(),
                    ),
                  ),
                ),
                Padding(
                  padding: EdgeInsetsDirectional.fromSTEB(16, 0, 0, 0),
                  child: Column(
                    mainAxisSize: MainAxisSize.max,
                    mainAxisAlignment: MainAxisAlignment.center,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        name,
                      ),
                      Padding(
                        padding: EdgeInsetsDirectional.fromSTEB(0, 4, 0, 0),
                        child: Text(
                          name,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget defaultElementWithImageStartUpList(List<StartUpDao> elements) {
    return Container(
        child: ListView.builder(
            shrinkWrap: true,
            padding: const EdgeInsets.all(8),
            itemCount: elements.length,
            itemBuilder: (BuildContext context, int index) {
              return Container(
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Column(
                    children: [
                      ElementsPrefab().defaultElementWithImageOnPress(
                          context,
                          elements[index].name,
                          elements[index].description, () {
                        AccessNavigator.accessTo(
                            context,
                            StartUpDetailActivity(
                                title: elements[index].name,
                                startUpId: elements[index].id));
                      }),
                      Divider(color: Colors.black)
                    ],
                  ),
                ),
              );
            }));
  }

  Widget defaultFolderElementsList(List<Widget> elements) {
    /*return Container(
        child: Padding(
      padding: const EdgeInsets.all(8.0),
      child: Wrap(children: elements),
    ));*/
    return SingleChildScrollView(
      scrollDirection: Axis.vertical,
      child: Wrap(direction: Axis.horizontal, children: elements),
    );
  }

  Widget defualtFileElement(
      BuildContext context, String title, String subTitle) {
    return Container(
        height: 100,
        child: Column(children: [
          TextPrefab.mediumText(context, title),
          TextPrefab.smallText(context, subTitle),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Expanded(
                    child: Center(
                        child: ButtonPrefab.defaultButton("Ver", () => null))),
                VerticalDivider(width: 8.0),
                Expanded(
                    child: Center(
                        child: ButtonPrefab.defaultButton(
                            "Descargar", () => null))),
              ],
            ),
          ),
        ]));
  }

  Widget defualtFileElementList(List<Map<String, dynamic>> elements) {
    print(elements.toString());
    return Container(
        child: ListView.builder(
            shrinkWrap: true,
            padding: const EdgeInsets.all(8),
            itemCount: elements.length,
            itemBuilder: (BuildContext context, int index) {
              return Container(
                child: Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: Column(
                    children: [
                      ElementsPrefab().defualtFileElement(
                          context,
                          elements[index]["title"],
                          elements[index]['subTitle']),
                      Divider(color: Colors.black)
                    ],
                  ),
                ),
              );
            }));
  }
}
