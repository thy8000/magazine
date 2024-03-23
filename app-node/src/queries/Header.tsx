import { gql } from "@apollo/client";

export const HeaderQuery = gql`
    {
        customLogo {
          description
          height
          url
          width
        }
        themeOptionsHeader {
          categoriesList
        }
        customSocialShares {
          data
        }
    }
`;