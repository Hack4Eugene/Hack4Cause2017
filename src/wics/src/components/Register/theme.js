import {
  red900, red700,
  redA700,
  grey100, grey300, grey400, grey500,
  white, darkBlack, fullBlack,
} from 'material-ui/styles/colors';

import spacing from 'material-ui/styles/spacing';

/**
 *  Light Theme is the default theme used in material-ui. It is guaranteed to
 *  have all theme variables needed for every component. Variables not defined
 *  in a custom theme will default to these values.
 */
export default {
  spacing: spacing,
  fontFamily: 'Roboto, sans-serif',
  borderRadius: 2,
  palette: {
  primary1Color: red900,
  primary2Color: red700,
  primary3Color: grey400,
  accent1Color: redA700,
  accent2Color: grey100,
  accent3Color: grey500,
  textColor: darkBlack,
  alternateTextColor: white,
  canvasColor: white,
  borderColor: grey300,
  pickerHeaderColor: red900,
  shadowColor: fullBlack,
  },
};