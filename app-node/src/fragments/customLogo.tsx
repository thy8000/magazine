import { useQuery, gql } from "@apollo/client";

export const CustomLogoFragment = gql`
  fragment CustomLogoFragment on CustomLogo {
    description
    height
    url
    width
  }
`;