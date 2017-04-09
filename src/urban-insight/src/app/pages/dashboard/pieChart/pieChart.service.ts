import {Injectable} from '@angular/core';
import {BaThemeConfigProvider, colorHelper} from '../../../theme';

@Injectable()
export class PieChartService {

  constructor(private _baConfig:BaThemeConfigProvider) {
  }

  getData() {
    let pieColor = this._baConfig.get().colors.custom.dashboardPieChart;
    return [
      {
        color: pieColor,
        description: 'Employment',
        stats: '57,820',
        icon: 'money',
      }, {
        color: pieColor,
        description: 'Housing',
        stats: '$ 89,745',
        icon: 'person',
      }, {
        color: pieColor,
        description: 'Population',
        stats: '11,642',
        icon: 'person',
      }, {
        color: pieColor,
        description: 'Crime',
        stats: '1',
        icon: 'money',
      }
    ];
  }
}
